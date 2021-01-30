// This is an anonymous function

(function () {

    var path = null;

    var div = null;
    var topLayer = null;
    var img = null;
    var input = null;
    var comment = null;
    var newElem = null;
    var comments = null;
    var newpath = null;
    var Username = null;
    var userCreds = null;
    var likeIcon = null;
    var lowerDiv = null;
    var likesNumber = null;
    var likes = null;
    var deleteIcon;
    var deleteElem;
    var x = null;

    function startup() {

        div = document.getElementById('cmt-img');
        input = document.getElementById('input');
        comment = document.getElementById('comment');
        comments = document.getElementById('comments');
        likeIcon = document.querySelector('.upper-div span');
        lowerDiv = document.getElementById('smaller');
        topLayer = document.getElementById('top-layer');
        x = localStorage.getItem("username");

        Username = x.trim();

        // console.log(window.location.search.substr(1));

        path = (window.location.search.substr(1)).substr(5);

        newpath = "/var/www/camagru-ik.cf/html".concat(path.substring(2));

        addPreviousComments(newpath);
        getNumberOfLikes(newpath);

        console.log(userCreds);

        img = document.createElement('img');
        img.src = path;

        img.style.width = '100%';
        img.style.height = '80%';

        div.appendChild(img);

        comment.addEventListener('click', function (ev) {
            addComment(input.value);
            input.value = '';
            ev.preventDefault();
        }, false);

        div.addEventListener('mouseover', function(ev) {
          console.log("You fucking touched it");

          // Add likes on hover
          hoverLikes();
        }, false);

        div.addEventListener('mouseleave', function(ev) {
          console.log("You fucking touched it");

          // Remove the appended style
          div.className = '';
          likes.className = '';
          likes = '';
        }, false);
    }

    function addComment(comment) {

      console.log(Username);

        var str = '/var/www/camagru-ik.cf/html';

        createCmtElem(comment);

        newpath = str.concat(path.substring(2));

        try {
            fetch("https://camagru-ik.cf/api/post/comment.php", {
              method: "POST",
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
              },
              body: JSON.stringify({ filename: newpath, comment: comment }),
            })
              .then((res) => res.text())
              .then((data) => {
                if (data == '{"Message":"Commented Successfully"}') {
                  console.log('Success');
                  console.log(data);
                } else {
                  console.log(data);
                }
              });
          } catch (error) {
            console.log(error);
          }

    }

    function createCmtElem(comment) {

      console.log(Username);

        newElem = document.createElement('div');
        deleteIcon = document.createElement('IMG');
        editElem = document.createElement('span');
        deleteElem = document.createElement('span');

        newElem.style.cssText = 'border: 1px solid #ABABAB; margin-top: 10px; border-radius: 3px; padding: 20px; width: 100%;';

        deleteIcon.setAttribute('src', '../assets/delete-32.png')

        // and give it some content
        var newContent = document.createTextNode(comment);
        var username = document.createTextNode(Username);

        // is this jquery ?
        // because if it is then it's already fucked up
        var first_span = document.createElement('span');
        first_span.setAttribute('style', 'font-size: 10px; color: #9364A8; margin-top: 2px'); /*just an example, your styles set here*/

        var second_span = document.createElement('span');
        second_span.setAttribute('style', 'color: black; margin-left: 20px;'); /*just an example, your styles set here*/

        editElem.className = 'edit-elem';

        first_span.appendChild(username);
        second_span.appendChild(newContent);

        var edit = document.createTextNode('Edit')
        editElem.appendChild(edit);

        var Delete = document.createTextNode('Delete');
        deleteElem.appendChild(Delete);

        // add the text node to the newly created div
        // newElem.appendChild(first_span);

        // Appending all elements to the principal container

        newElem.appendChild(first_span);
        newElem.appendChild(second_span);
        newElem.appendChild(newContent);

        newElem.appendChild(editElem);
        newElem.appendChild(deleteElem);

        // comments.appendChild(el_span);
        comments.appendChild(newElem);

    }

    function addCommentBlocks(data) {

      console.log(Username);

      var regex = /(?<={"comment":")(.*)(?="})/g;

      data = data.substring(9).slice(0, -2);

      console.log(data);

      var array = data.split(',');

      for (i=0; i < array.length; i++) {

        array[i] = array[i].match(regex);

        createCmtElem(array[i]);

      }

    }


    // Add previous comments to the commented image

    function addPreviousComments(newpath) {

      console.log(newpath);

      try {
        fetch("https://camagru-ik.cf/api/post/get_comments.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ filename: newpath }),
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"message":"No Comments Found"}') {
              console.log('Comments Not Found');

            } else {
              addCommentBlocks(data);
            }
          });
      } catch (error) {
        console.log(error);
      }

    }

    function addLikesNumber(response) {

      var obj = JSON.parse(response);
      var likes = document.createTextNode(obj.likes);

      console.log(likeIcon);

      likeIcon.appendChild(likes);
      // lowerDiv.appendChild(likeIcon);


      console.log(obj.likes);

      likesNumber = obj.likes;

    }

    async function getNumberOfLikes(newpath) {

      try {
        const response = await fetch("https://camagru-ik.cf/api/post/get_post_credentials.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ filename: newpath }),
        })
          .then((res) => res.text())

          addLikesNumber(response);
          
      } catch (error) {
        console.log(error);
      }

    }

    function hoverLikes() {

      likes = document.createTextNode(likesNumber);
      div.className = 'top-layer';
      likes.className = 'likes-number';

      console.log(likes);

      div.appendChild(likes);
    }

    window.addEventListener('load', startup, false);
})();