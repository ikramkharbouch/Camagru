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

        newElem = document.createElement('div');

        // and give it some content
        const newContent = document.createTextNode(comment);

        // add the text node to the newly created div
        newElem.appendChild(newContent);

        comments.appendChild(newElem);

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

    function addCommentBlocks(data) {

      var regex = /(?<={"comment":")(.*)(?="})/g;

      data = data.substring(9).slice(0, -2);

      console.log(data);

      var array = data.split(',');

      for (i=0; i < array.length; i++) {

        array[i] = array[i].match(regex);
        
        newElem = document.createElement('div');

        // and give it some content
        const newContent = document.createTextNode(array[i]);

        // add the text node to the newly created div
        newElem.appendChild(newContent);

        comments.appendChild(newElem);

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