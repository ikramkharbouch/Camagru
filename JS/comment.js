// This is an anonymous function

(function () {

    var path = null;

    var div = null;
    var img = null;
    var input = null;
    var comment = null;
    var newElem = null;
    var comments = null;
    var newpath = null;

    function startup() {

        div = document.getElementById('cmt-img');
        input = document.getElementById('input');
        comment = document.getElementById('comment');
        comments = document.getElementById('comments');

        // console.log(window.location.search.substr(1));

        path = (window.location.search.substr(1)).substr(5);

        newpath = "/var/www/camagru-ik.cf/html".concat(path.substring(2));

        addPreviousComments(newpath);

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
    }

    function addComment(comment) {

        var str = '/var/www/camagru-ik.cf/html';

        createCmtElem("Username", comment);

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

    function createCmtElem(Username, comment) {

      newElem = document.createElement('div');

        newElem.style.cssText = 'border: 1px solid #ABABAB; margin-top: 10px; border-radius: 3px; padding: 20px; width: 100%;';

        // and give it some content
        var newContent = document.createTextNode(comment);
        var Username = document.createTextNode("Username ");

        // is this jquery ?
        // because if it is then it's already fucked up
        var first_span = document.createElement('span');
        first_span.setAttribute('style', 'font-size: 10px; color: #9364A8; margin-top: 2px'); /*just an example, your styles set here*/

        var second_span = document.createElement('span');
        second_span.setAttribute('style', 'color: black; margin-left: 20px;'); /*just an example, your styles set here*/

        first_span.appendChild(Username);
        second_span.appendChild(newContent);

        // add the text node to the newly created div
        // newElem.appendChild(first_span);

        newElem.appendChild(first_span);
        newElem.appendChild(second_span);
        newElem.appendChild(newContent);

        // comments.appendChild(el_span);
        comments.appendChild(newElem);

    }

    function addCommentBlocks(data) {

      var regex = /(?<={"comment":")(.*)(?="})/g;

      data = data.substring(9).slice(0, -2);

      console.log(data);

      var array = data.split(',');

      for (i=0; i < array.length; i++) {

        array[i] = array[i].match(regex);

        createCmtElem("Username", array[i]); 

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

    window.addEventListener('load', startup, false);
})();