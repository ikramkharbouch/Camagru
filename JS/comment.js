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

    var x = null;
    var comment_id = 0;
    var Cmt_username;

    var sharebutton = null;

    var comment_ids = new Array();

    async function startup() {

        div = document.getElementById('cmt-img');
        input = document.getElementById('input');
        comment = document.getElementById('comment');
        comments = document.getElementById('comments');
        likeIcon = document.querySelector('.upper-div span');
        lowerDiv = document.getElementById('smaller');
        topLayer = document.getElementById('top-layer');
        x = localStorage.getItem("username");
        sharebutton = document.getElementById("sharebutton");

        Username = x.trim();

        post_id = (window.location.search.substr(1)).substr(3);

        newpath = await get_path(post_id);

        if (newpath == 'Image does not exist')
            window.location.href = '../404.php';

        addPreviousComments(newpath);
        getNumberOfLikes(newpath);

        var regex = /(?<=\/var\/www\/camagru-ik.cf\/html)(.*)(?=)/g;
        
        path = newpath.match(regex);

        img = document.createElement('img');
        img.src = path;

        img.style.width = '100%';
        img.style.height = '80%';

        div.appendChild(img);


        comment.addEventListener('click', function (ev) {
          ev.preventDefault();
          if ((input.value.trim()).length) {
            addComment(input.value);
            input.value = '';
          }
        }, false);

        sharebutton.addEventListener('click', function (ev) {
          ev.preventDefault();
          shareOnFacebook(img);
        }, false);
    }

    async function get_path(post_id) {

      try {
        let response = await fetch("https://camagru-ik.cf/api/post/get_path.php", {
          method: "POST",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ post_id: post_id }),
        })
          .then((res) => res.text())
          return (response);
      } catch (error) {
        //console.log(error);
      }
    }

    function addComment(comment) {

        var str = '/var/www/camagru-ik.cf/html';

        createCmtElem(comment, Username);

        //console.log(path);
        newpath = str.concat(path);
        //console.log(newpath);


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
                  //console.log(data);
                } else {
                  //console.log(data);
                }
              });
          } catch (error) {
            //console.log(error);
          }

    }
    
    function  createCmtElem(comment, parameter) {
      
      newElem = document.createElement('div');
      
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
      
      first_span.appendChild(username);
      second_span.appendChild(newContent);

      // Set an id for the comment

      second_span.setAttribute('id', 'comment');
      
      
      // Appending all elements to the principal container
      
      newElem.appendChild(first_span);
      newElem.appendChild(second_span);
    

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
              //console.log('Comments Not Found');

            } else {
              addCommentBlocks(data);
            }
          });
      } catch (error) {
        //console.log(error);
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
        //console.log(error);
      }

    }

    function shareOnFacebook(TheImg) {
      var u=TheImg.src;
     // t=document.title;
      var t=TheImg.getAttribute('alt');
      window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;
    }

    window.addEventListener('load', startup, false);
})();