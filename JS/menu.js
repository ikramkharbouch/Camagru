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
    var profile_pic = null;
    
    function startup() {
      
      get_username();
      profile = document.querySelector(".user-details p");
      profile_pic = document.querySelector(".user-details img");

      setup_profile_pic(profile_pic);
      
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
              //console.log('User Not Found');
            } else {
              x.innerText = data;
              // Set the variable in the browser so comment.js can access to it
              localStorage.setItem("username",data);
            }
          });
      } catch (error) {
        //console.log(error);
      }

    }


    function setup_profile_pic(profile_pic) {

      try {
        fetch("https://camagru-ik.cf/api/post/get_pdp.php", {
          method: "GET",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"message":"No Profile Picture Found"}') {
              profile_pic.src = "../assets/avatar.png";
            } else {
              profile_pic.src =  "../".concat(data.substring(28));
            }
          });
      } catch (error) {
        //console.log(error);
      }
    }
    
    window.addEventListener('load', startup, false);
  })();