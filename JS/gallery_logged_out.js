(function () {

    var getimages = null;
    var offset = 0;
    var inc = -1;
    var src = null;
    var cardbody = null;

    var cmtImg = null;
    var index = 0;
 
    var path = null;
  
    function startup() {
  
      window.onscroll = function () { getpictures() };
      getimages = document.getElementById('getimages');
      src = document.getElementById('container');
      cardbody = document.getElementById('card-body');
      cmtImg = document.getElementById('cmt-img');
  
      getpictures();
    }
  
    function getpictures() {
  
      inc += 1;
      offset = 5 * inc;
  
      try {
        fetch("https://camagru-ik.cf/api/post/gallery.php" + "?offset=" + offset, {
          method: "GET",
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
        })
          .then((res) => res.text())
          .then((data) => {
            if (data == '{"Message":"No Posts Found"}') {
              //console.log("Error");
            } else {
              manipulate_data(data);
            }
          });
      } catch (error) {
        //console.log(error);
      }
    }
  
    function create_card(paths)
    {
      var img;
      var div;
  
      for (let i = 0; i < paths.length; i++) {
        path = paths[i];
  
        img = document.createElement('img');
        div = document.createElement('div');
        cardBody = document.createElement('div');
  
        div.className = 'try';
  
        img.className = 'img';
        
        div.id = index++;
  
        img.src = path;
        cardBody.className = 'card-footer';
        cardBody.style.backgroundColor = '#9364A8';
        cardBody.style.height = '100px';
        div.appendChild(img);
  
        div.appendChild(cardBody);
        src.appendChild(div);
    }
  
    }

    function create_path(data)
    {
      var str = '..';
      var regex = /((\/img\/)|(\/upload\/)).*?((.png)|(.jpeg)|(.jpg)).*?/g;
      var regex_likes = /(?<=,"likes":")(.*)(?=",)/g;
      var regex_comments = /(?<=,"comments":")(.*)(?=")/g;
      var found;
  
      data = (data.substring(9)).slice(0, -2);
      var array = data.split('},');
  
      likes = new Array(array.length);
      comments = new Array(array.length);
  
      for (i = 0; i < array.length; i++) {
        array[i] = array[i].replace(/\\\//g, "/");
        likes[i] = array[i].match(regex_likes);
        comments[i] = array[i].match(regex_comments);
        found = array[i].match(regex);
        array[i] = str.concat(found);
      }
  
      return array;
    }
  
    function manipulate_data(data)
    {
      var paths;
    
      paths = create_path(data);
  
      create_card(paths);
      
    }
  
    window.addEventListener('load', startup, false);
  })();