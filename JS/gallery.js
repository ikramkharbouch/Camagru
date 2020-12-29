function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

(function () {
  
    var getimages = null;
    var offset = 0;
    var inc = -1;
    var i;
    var src = null;
    var cardbody = null;
    var likeIcon = null;
    var commentIcon = null;
  
    function startup() {

      window.onscroll = function() {getpictures()};
      getimages = document.getElementById('getimages');
      src = document.getElementById('container');
      cardbody = document.getElementById('card-body');

      getpictures();

      // getimages.addEventListener('click', function (ev) {
      //   getpictures();
      //   ev.preventDefault();
      // }, false);

      // likeIcon.addEventListener('click', function (ev) {
      //   console.log('liked');
      //   ev.preventDefault();
      // }, false);

      // commentIcon.addEventListener('click', function (ev) {
      //   console.log('liked');
      //   ev.preventDefault();
      // }, false);
    }

    function getpictures() {

      inc += 1;
      offset = 5 * inc;

      console.log(offset);

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

      function like() {
        console.log("liked");
      }
      
      function manipulate_data(data)
      {
        var img;
        var div;
        var str = '../img/';

        data = data.substring(9);
        data = data.slice(0, -2);
        var array = data.split(',');
        for (i = 0; i < array.length; i++) {
          array[i] = array[i].substring(47);
          array[i] = array[i].slice(0, -2);
          array[i] = str.concat(array[i]);

          img = document.createElement('img');
          div = document.createElement('div');
          cardBody = document.createElement('div');
          likeIcon = document.createElement('IMG');
          likeIcon.setAttribute('src', '../assets/like.png');

          commentIcon = document.createElement('IMG');
          commentIcon.setAttribute('src', '../assets/comment.png');

          likeIcon.style.width = '20px';
          likeIcon.style.height = '20px';

          commentIcon.style.width = '20px';
          commentIcon.style.height = '20px';

          commentIcon.style.marginLeft = '25px';

          div.style.marginTop = '30px';
          div.style.marginLeft = '20px';

          img.style.height = '100%';
          img.style.width = '100%';
          img.style.margin = '0';
          div.style.width = '500px';
          div.style.height = '500px';
          img.src = array[i];
          cardBody.className = 'card-footer';
          cardBody.style.backgroundColor = '#9364A8';
          cardBody.style.height = '100px';
          div.appendChild(img);
          cardBody.appendChild(likeIcon);
          cardBody.appendChild(commentIcon);
          div.appendChild(cardBody);
          src.appendChild(div);
          div.className = 'card';
  
        }
    }

    window.addEventListener('load', startup, false);
  })();