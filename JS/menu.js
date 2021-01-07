function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }
  
  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }

  (function () {

    var x = null;
    var profile = null;
    
    function startup() {
      
      get_username();
      profile = document.querySelector(".user-details p");;

      console.log(profile);

      profile.addEventListener('click', function (ev) {
        console.log('profile');
        window.location.href = "../forms/profile.php";
        ev.preventDefault();
      }, false);
      
    }
    
    function get_username() {
      
      x = document.querySelector(".user-details p");

      try {
        fetch("https://camagru-ik.cf/api/post/get_user.php", {
          method: "GET",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"No Username Found"}') {
              console.log('User Not Found');
            } else {
              x.innerText = data;
              // Set the variable in the browser so comment.js can access to it
              localStorage.setItem("username",data);
            }
          });
      } catch (error) {
        console.log(error);
      }

    }
    
    window.addEventListener('load', startup, false);
  })();