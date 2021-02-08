// This is an anonymous function

(function () {

    var form = null;

    function startup() {

        form = document.getElementById("checkUser");

        form.addEventListener('submit', function (ev) {
            resetPassword(ev);
            ev.preventDefault();
        }, false);

    }
      
      function resetPassword(e) {
        e.preventDefault();
      
        let email = document.getElementById("email").value;

        try {
            fetch("https://camagru-ik.cf/api/post/reset_password.php", {
              method: "POST",
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
              },
              body: JSON.stringify({ email: email }),
            })
              .then((res) => res.text())
              .then((data) => {
                if (data == 'Email sent successfully') {
                    window.location.href = '../redirect_pages/reset.php';
                } else {
                  window.location.href = '../redirect_pages/email_not_found.php';
                }
              });
          } catch (error) {
            // console.log(error);
          }
      }

    window.addEventListener('load', startup, false);
})();


