// This is an anonymous function

(function () {

    var addUser = null;
    var getUser = null;

    function startup() {

        addUser = document.getElementById("addPost");
        getUser = document.getElementById("getUsers");

        addUser.addEventListener('submit', function (ev) {
            addPost(ev);
            ev.preventDefault();
        }, false);

        getUser.addEventListener('click', function (ev) {
            getUsers();
            ev.preventDefault();
        }, false);

    }

    function addPost(e) {
        e.preventDefault();

        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let pass = document.getElementById("pass").value;

        fetch("https://camagru-ik.cf/api/post/create.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ username: username, email: email, pass: pass }),
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
                }

            });
    }

    function getUsers() {
        fetch("https://camagru-ik.cf/api/post/read_single.php?id=2")
            .then((res) => res.json())
            .then((data) => console.log(data))
            .catch((err) => console.log(err));
    }

    window.addEventListener('load', startup, false);
})();




















