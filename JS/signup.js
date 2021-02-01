// This is an anonymous function

(function () {

    var addUser = null;

    function startup() {

        addUser = document.getElementById("addPost");

        addUser.addEventListener('submit', function (ev) {
            addPost(ev);
            ev.preventDefault();
        }, false);

    }

    function addPost(e) {
        e.preventDefault();

        let fullname = document.getElementById("fullname").value;
        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let pass = document.getElementById("pass").value;

        fetch("https://camagru-ik.cf/api/post/create.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ fullname: fullname, username: username, email: email, pass: pass }),
        })
            .then((res) => res.text())
            .then((data) => {
                if (data == '{"Message":"User Exists"}') {
                    document.getElementById("message").innerHTML = "This email or username already exists";
                } else if (data == '{"Message":"Post Not Created"}') {
                    document.getElementById("message").innerHTML = "Email or password doesn't have the minimum requirements";
                } else if (data == '{"Message":"Post Created"}') {
                    console.log('User Created');
                    window.location.href = "./signin.php";
                } else {
                    console.log('a problem occured');
                    console.log(data);
                }

            });
    }

    window.addEventListener('load', startup, false);
})();




















