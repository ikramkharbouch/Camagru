// This is an anonymous function

(function () {

    var path = null;

    var div = null;
    var img = null;
    var input = null;
    var comment = null;
    var newElem = null;
    var comments = null;

    function startup() {

        div = document.getElementById('cmt-img');
        input = document.getElementById('input');
        comment = document.getElementById('comment');
        comments = document.getElementById('comments');

        path = (window.location.search.substr(1)).substr(5);

        img = document.createElement('img');
        img.src = path;

        img.style.width = '100%';
        img.style.height = '80%';

        div.appendChild(img);

        comment.addEventListener('click', function (ev) {
            addComment(input.value);
            ev.preventDefault();
        }, false);
    }

    function addComment(comment) {

        newElem = document.createElement('div');

        // and give it some content
        const newContent = document.createTextNode(comment);

        // add the text node to the newly created div
        newElem.appendChild(newContent);

        comments.appendChild(newElem);

    }

    window.addEventListener('load', startup, false);
})();