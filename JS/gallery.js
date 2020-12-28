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
  
    function startup() {

      window.onscroll = function() {getpictures()};
      getimages = document.getElementById('getimages');
      src = document.getElementById('container');

      getpictures();

      getimages.addEventListener('click', function (ev) {
        getpictures();
        ev.preventDefault();
      }, false);
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
              console.log(data);
              data = data.substring(9);
              data = data.slice(0, -2);
              console.log(data);
              var array = data.split(',');
              console.log(array);
              for (i = 0; i < array.length; i++) {
                array[i] = array[i].substring(47);
                array[i] = array[i].slice(0, -2);
                var str = '../img/';
                array[i] = str.concat(array[i]);
                console.log(array[i]);
                var img = document.createElement('img');
                img.style.height = '500px';
                img.style.width = '500px';
                img.src = array[i];
                console.log("Image source is");
                console.log(img.src);
                src.appendChild(img);
              }
            }
          });
      } catch (error) {
          console.log(error);
      }
      
    }

    window.addEventListener('load', startup, false);
  })();