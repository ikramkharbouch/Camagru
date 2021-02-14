// This is an anonymous function

(function () {

    var addUser = null;
    var errorMsg = null;

    function startup() {

        addUser = document.getElementById("addPost");
        errorMsg = document.querySelector('p');

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
                    errorMsg.innerHTML = "This email or username already exists";
                } else if (data == '{"Message":"Post Not Created"}') {
                    errorMsg.innerHTML = 'Email should be valid <br /> Fullname should have at least 3 letters with no numbers or characters <br />Username should have at least 3 letters with no numbers or characters <br />Password should contain at least 8 characters including numbers and a special character and a capital letter';
                } else if (data == '{"Message":"Post Created"}') {
                    window.location.href = "./signin.php";
                } else {
                    errorMsg = 'An error occured';
                }

            });
    }

    window.addEventListener('load', startup, false);
})();




















