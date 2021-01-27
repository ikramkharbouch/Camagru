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
    console.log(path);

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

  async function like(path, div) {

    let checkUser = await check_user_likes(path);
    console.log("return value: ",checkUser);

    if (checkUser == true)
      liked = 1;
    else
      liked = 0;

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

  async function liked_or_disliked(path) {

    let checkUser = await check_user_likes(path);

    if (checkUser == true)
      liked = 1;
    else
      liked = 0;

    if (liked == 1)
      return ('../assets/like-black-32.png');
    
    return ('../assets/like.png');

  }

  function commented_or_uncommented(comments) {

    if (parseInt(comments))
      return ('../assets/comment-black-32.png');

    return ('../assets/comment.png');

  }

  async function create_card(path, likes, comments)
  {
    var img;
    var div;
    var checkLike;

    checkLike = await liked_or_disliked(path);

    console.log("The return value is " + checkLike + "for this path" + path);

    img = document.createElement('img');
    div = document.createElement('div');
    cardBody = document.createElement('div');
    likeIcon = document.createElement('IMG');
    likeText = document.createTextNode(likes);
    commentText = document.createTextNode(comments);
    DeleteIcon = document.createElement('IMG');
    likeIcon.setAttribute('src', checkLike);

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


    likeIcon.className = 'icon like-icon';

    commentIcon.className = 'icon comment-icon';

    DeleteIcon.className = 'icon delete-icon';

    div.className = 'try';

    img.className = 'img';
    
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

  async function check_user_likes(path) {

    var str = '/var/www/camagru-ik.cf/html';

    path = str.concat(path.substring(2));

    try {
      const response = await fetch("https://camagru-ik.cf/api/post/check_like.php", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ filename: path }),
      })
        .then((res) => res.text());

        console.log("received data: ",response)
      if (response == '{"message":"No Like Found"}') {
          return false;
        } else {
          return true;
        }

    } catch (error) {
      console.log(error);
    }

  }

  window.addEventListener('load', startup, false);
})();