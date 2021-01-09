(function () {

  var getimages = null;
  var offset = 0;
  var inc = -1;
  var i;
  var src = null;
  var cardbody = null;
  var likeIcon = null;
  var commentIcon = null;
  var cmtImg = null;
  var liked = 0;
  var index = 0;

  var likes = null;
  var comments = null;
  var DeleteIcon = null;

  var likeText = null;
  var commentText = null;

  function startup() {

    window.onscroll = function () { getpictures() };
    getimages = document.getElementById('getimages');
    src = document.getElementById('container');
    cardbody = document.getElementById('card-body');
    cmtImg = document.getElementById('cmt-img');

    getpictures();
  }

  function getpictures() {

    inc += 1;
    offset = 5 * inc;

    try {
      fetch("https://camagru-ik.cf/api/post/gallery.php" + "?offset=" + offset, {
        method: "GET",
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
      })
        .then((res) => res.text())
        .then((data) => {
          if (data == '{"Message":"No Posts Found"}') {
            console.log("Error");
          } else {
            manipulate_data(data);
          }
        });
    } catch (error) {
      console.log(error);
    }
  }

  function send_query(parameter, path) {

    var str = '/var/www/camagru-ik.cf/html';

    path = str.concat(path.substring(2));

    try {
      fetch("https://camagru-ik.cf/api/post/" + parameter + ".php", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ filename: path }),
      })
        .then((res) => res.text())
        .then((data) => {
          if (data == '{"Message":"' + parameter + 'd Successfully"}') {
            console.log(parameter +'d');
            console.log(data);
          } else {
            console.log(data);
          }
        });
    } catch (error) {
      console.log(error);
    }
  }

  function like(path, div) {

    if (liked == 0)
    {
      liked = 1;
      div.getElementsByTagName('img')[1].src = '../assets/like-black-32.png';
      send_query('like', path);

    } else {

      liked = 0;
      div.getElementsByTagName('img')[1].src = '../assets/like.png';
      send_query('dislike', path);
    }
    
  }

  function comment(path) {

    // var image;
    console.log(path);
    window.location.href = "../forms/comment.php" + '?path=' + path;
    // image = document.createElement('img');

    // image.src = path;

    // cmtImg.appendChild(image);
  }

  function delete_img(path, div) {

    // var str = '/var/www/camagru-ik.cf/html';

    // path = str.concat(path.substring(2));
    console.log(path);
    console.log(div);

    div.remove();
    send_query('delete', path);

  }

  function create_path(data)
  {
    var str = '..';
    var regex = /((\/img\/)|(\/upload\/)).*?((.png)|(.jpeg)|(.jpg)).*?/g;
    var regex_likes = /(?<=,"likes":")(.*)(?=",)/g;
    var regex_comments = /(?<=,"comments":")(.*)(?=")/g;
    var found;

    data = (data.substring(9)).slice(0, -2);
    var array = data.split('},');

    likes = new Array(array.length);
    comments = new Array(array.length);

    for (i = 0; i < array.length; i++) {
      array[i] = array[i].replace(/\\\//g, "/");
      likes[i] = array[i].match(regex_likes);
      comments[i] = array[i].match(regex_comments);
      found = array[i].match(regex);
      array[i] = str.concat(found);
    }
    
    return array;
  }

  function liked_or_disliked(likes) {

    if (parseInt(likes))
      return ('../assets/like-black-32.png');

    return ('../assets/like.png');

  }

  function commented_or_uncommented(comments) {

    if (parseInt(comments))
      return ('../assets/comment-black-32.png');

    return ('../assets/comment.png');

  }

  function create_card(path, likes, comments) 
  {
    var img;
    var div;

    img = document.createElement('img');
    div = document.createElement('div');
    cardBody = document.createElement('div');
    likeIcon = document.createElement('IMG');
    likeText = document.createTextNode(likes);
    commentText = document.createTextNode(comments);
    DeleteIcon = document.createElement('IMG');
    likeIcon.setAttribute('src', liked_or_disliked(likes));

    commentIcon = document.createElement('IMG');
    commentIcon.setAttribute('src', commented_or_uncommented(comments));

    DeleteIcon.setAttribute('src', '../assets/delete-32.png');

    likeIcon.addEventListener('click', function (ev) {
      like(path, div);
      ev.preventDefault();
    }, false);

    commentIcon.addEventListener('click', function (ev) {
      comment(path);
      ev.preventDefault();
    }, false);

    DeleteIcon.addEventListener('click', function (ev) {

      // Add are you sure you want to delete later!

      delete_img(path, div);
      ev.preventDefault();
    }, false);

    likeIcon.style.width = '20px';
    likeIcon.style.height = '20px';
    likeIcon.style.cursor = 'pointer';

    commentIcon.style.width = '20px';
    commentIcon.style.height = '20px';
    commentIcon.style.cursor = 'pointer';

    commentIcon.cssText = 'cursor: pointer;';

    commentIcon.style.marginLeft = '25px';

    DeleteIcon.style.width = '20px';
    DeleteIcon.style.height = '20px';
    DeleteIcon.style.cursor = 'pointer';

    DeleteIcon.style.marginLeft = '325px';

    div.style.marginTop = '30px';
    div.style.marginLeft = '20px';

    img.style.height = '100%';
    img.style.width = '100%';
    img.style.margin = '0';

    div.style.width = '500px';
    div.style.height = '500px';

    div.id = index++;

    img.src = path;
    cardBody.className = 'card-footer';
    cardBody.style.backgroundColor = '#9364A8';
    cardBody.style.height = '100px';
    div.appendChild(img);
    cardBody.appendChild(likeIcon);
    cardBody.appendChild(likeText);
    cardBody.appendChild(commentIcon);
    cardBody.appendChild(commentText);
    cardBody.appendChild(DeleteIcon);
    div.appendChild(cardBody);
    src.appendChild(div);
    div.className = 'card';

    // To edit later with TextCss property

  }


  function manipulate_data(data)
  {
    var paths;

    var regex = /^(..\/img\/|..\/upload\/)\/*.+/g;
  
    paths = create_path(data);

    for (i = 0; i < paths.length; i++) {
      if (paths[i].match(regex))
        create_card(paths[i], likes[i], comments[i]);
      else
        continue;
    }
    
  }

  window.addEventListener('load', startup, false);
})();