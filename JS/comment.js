// This is an anonymous function

(function () {

    var path = null;

    var div = null;
    var img = null;
    var input = null;
  
    function startup() {

        div = document.getElementById('cmt-img');
        input = document.getElementById('input');

        path = (window.location.search.substr(1)).substr(5);
        console.log(input.value);

        img = document.createElement('img');
        img.src = path;

        img.style.width = '100%';
        img.style.height = '80%';

        div.appendChild(img);
  
    }

    window.addEventListener('load', startup, false);
  })();