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
            console.log(data);
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
    console.log(parameter);

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
      console.log(array[i]);
      likes[i] = array[i].match(regex_likes);
      comments[i] = array[i].match(regex_comments);
      found = array[i].match(regex);
      array[i] = str.concat(found);
    }
    
    return array;
  }

  function create_card(path, likes, comments) 
  {
    var img;
    var div;


    console.log(likes);
    console.log(comments);

    img = document.createElement('img');
    div = document.createElement('div');
    cardBody = document.createElement('div');
    likeIcon = document.createElement('IMG');
    likeText = document.createTextNode(likes);
    commentText = document.createTextNode(comments);
    likeIcon.setAttribute('src', '../assets/like.png');

    commentIcon = document.createElement('IMG');
    commentIcon.setAttribute('src', '../assets/comment.png');

    likeIcon.addEventListener('click', function (ev) {
      like(path, div);
      ev.preventDefault();
    }, false);

    commentIcon.addEventListener('click', function (ev) {
      comment(path);
      ev.preventDefault();
    }, false);

    likeIcon.style.width = '20px';
    likeIcon.style.height = '20px';
    likeIcon.style.cursor = 'pointer';

    commentIcon.style.width = '20px';
    commentIcon.style.height = '20px';
    commentIcon.style.cursor = 'pointer';

    commentIcon.style.marginLeft = '25px';

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
    div.appendChild(cardBody);
    src.appendChild(div);
    div.className = 'card';

  }

  function manipulate_data(data) 
  {
    var paths;
  
    paths = create_path(data);

    for (i = 0; i < paths.length; i++) {
      console.log(paths[i]);
      create_card(paths[i], likes[i], comments[i]);
    }
    
  }

  window.addEventListener('load', startup, false);
})();