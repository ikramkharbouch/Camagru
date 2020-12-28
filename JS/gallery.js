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
  
    function startup() {
      getimages = document.getElementById('getimages');
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
            if (data == '{"Message":"Images Not Imported"}') {
              console.log("Error");
            } else {
              console.log(data);
              data = data.substring(9);
              data = data.slice(0, -2);
              console.log(data);
              var array = data.split(',');
              console.log(array);
            }
          });
      } catch (error) {
          console.log(error);
      }
      
    }

    window.addEventListener('load', startup, false);
  })();