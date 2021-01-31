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
    var Username = null;
    var likeIcon = null;
    var likes = null;
    var editElem = null;
    var deleteElem = null;
    var editComment = null;
    var x = null;
    var comment_id = 0;
    var Cmt_username;

    var comment_ids = new Array();

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

        // input = document.getElementById('input').setAttribute('required', 'true');

        path = (window.location.search.substr(1)).substr(5);

        newpath = "/var/www/camagru-ik.cf/html".concat(path.substring(2));

        addPreviousComments(newpath);
        getNumberOfLikes(newpath);

        img = document.createElement('img');
        img.src = path;

        img.style.width = '100%';
        img.style.height = '80%';

        div.appendChild(img);

        console.log(input);


        comment.addEventListener('click', function (ev) {
          ev.preventDefault();
          if ((input.value.trim()).length) {
            addComment(input.value);
            input.value = '';
          }
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

        // Making a loop to listen to all children of parentElement
    }

    function  events(comments) {
      var children = comments.children;

      if (comments) {
          for(let i = 0; i < children.length; i++) {

            console.log(children[i]);

            var edit = children[i].querySelector('#edit' + i);
            var Delete = children[i].querySelector('#delete' + i);
            console.log(edit);
            console.log(Delete);

            edit.addEventListener('click', function(ev) {
              var newEdit = children[i].querySelector('#edit' + i);

              console.log(newEdit);
              newEdit.className = 'edit-hide';
              editCmt(children[i]);
            }, false);

            // TODO: Fix the pre deletion elements problem
            
            Delete.addEventListener('click', function(ev) {
              var newDelete = children[i].querySelector('#delete' + i);
              console.log(newDelete);

              newDelete.className = 'delete-hide';
              console.log(newDelete);
              deleteFromDatabase(children[i], children[i].querySelector('#comment').innerHTML);
            }, false);
          }
      }
    }

    function  editCmt(newElem) {

      editComment = document.createElement('input');
      var button = document.createElement('button');
      var container = document.createElement('div');

      button.innerHTML = 'Edit';

      editComment.setAttribute('style', 'padding: 10px; margin-top: 10px;');

      container.setAttribute('style', 'display: flex; flex-direction: column;');

      container.appendChild(editComment);
      container.appendChild(button);

      newElem.appendChild(container);

      button.addEventListener('click', function(ev) {
        var id = newElem.getAttribute('id');
        newElem.removeChild(container);
        newElem.querySelector('#comment').innerHTML = editComment.value;
        newElem.querySelector('#edit' + id).className = 'edit-elem';
        addtoDatabase(editComment.value);
      }, false);
    }

    function addtoDatabase(comment) {

      try {
        fetch("https://camagru-ik.cf/api/post/update_comment.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ filename: newpath, comment: comment }),
        })
          .then((res) => res.text())
          .then((data) => {
            console.log(data);
          })
      } catch (error) {
        console.log(error);
      }
    }

    function deleteFromDatabase(newElem, comment) {

      var i = newElem.getAttribute('id');

      newElem.remove();

      console.log(comment);
      console.log(comment_ids);

      try {
        fetch("https://camagru-ik.cf/api/post/delete_comment.php", {
          method: "DELETE",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ filename: newpath, comment: comment, comment_id: parseInt(comment_ids[i])}),
        })
          .then((res) => res.text())
          .then((data) => {
            console.log(data);
          })
      } catch (error) {
        console.log(error);
      }

    }

    function update_comment_ids(id) {
      
      // TODO: remove the comment id after removing an element and re arrange the array again
    }

    function addComment(comment) {

      console.log(Username);

        var str = '/var/www/camagru-ik.cf/html';

        createCmtElem(comment, Username);

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
    
    function  createCmtElem(comment, parameter) {
      
      newElem = document.createElement('div');
      editElem = document.createElement('span');
      deleteElem = document.createElement('span');
      
      newElem.style.cssText = 'border: 1px solid #ABABAB; margin-top: 10px; border-radius: 3px; padding: 20px; width: 100%;';
      
      // and give it some content
      var newContent = document.createTextNode(comment);
      var username = document.createTextNode(parameter);
      
      // is this jquery ?
      // because if it is then it's already fucked up
      var first_span = document.createElement('span');
      first_span.setAttribute('style', 'font-size: 10px; color: #9364A8; margin-top: 2px'); /*just an example, your styles set here*/
      
      var second_span = document.createElement('span');
      second_span.setAttribute('style', 'color: black; margin-left: 20px;'); /*just an example, your styles set here*/
      
      editElem.className = 'edit-elem';
      deleteElem.className = 'delete-elem';

      editElem.setAttribute('id', 'edit' + comment_id);
      deleteElem.setAttribute('id', 'delete' + comment_id);
      
      first_span.appendChild(username);
      second_span.appendChild(newContent);

      // Set an id for the comment

      second_span.setAttribute('id', 'comment');
      
      var edit = document.createTextNode('Edit');
      editElem.appendChild(edit);
      
      var Delete = document.createTextNode('Delete');
      deleteElem.appendChild(Delete);
      
      // Appending all elements to the principal container
      
      newElem.appendChild(first_span);
      newElem.appendChild(second_span);
      // newElem.appendChild(newContent);
      
      newElem.appendChild(editElem);
      newElem.appendChild(deleteElem);

      // Give the element an id;

      newElem.setAttribute('id', comment_id);

      comment_id += 1;
      
      comments.appendChild(newElem);
    }

    
    function addCommentBlocks(data) {
      
      var regex = /(?<="comment":").*?(?=",)/g;
      var regex_comment = /(?<=,"comment_id":").*?(?="})/g;
      var regex_username = /(?<=,"username":").*?(?="})/g;

      data = data.substring(9).slice(0, -2);

      var array = data.split(',{');

      for (i=0; i < array.length; i++) {

        comment_ids[i] = array[i].match(regex_comment);
        Cmt_username = array[i].match(regex_username);
        array[i] = array[i].match(regex);
        createCmtElem(array[i], Cmt_username);

      }

      events(comments);

    }


    // Add previous comments to the commented image

    function addPreviousComments(newpath) {

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
              console.log(data);
            }
          });
      } catch (error) {
        console.log(error);
      }

    }

    function addLikesNumber(response) {

      var obj = JSON.parse(response);
      var likes = document.createTextNode(obj.likes);


      likeIcon.appendChild(likes);
      // lowerDiv.appendChild(likeIcon);

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

      // likes = document.createTextNode(likesNumber);
      // div.className = 'top-layer';
      // likes.className = 'likes-number';

      // div.appendChild(likes);
    }

    // TODO: make the comment deletable and editable immediately after creating it

    window.addEventListener('load', startup, false);
})();