// This is an anonymous function
(function () {

    var input = null;
    var uploadbutton = null;

    var image = null;
    var fileList = null;
    var filter1 = null;
    var filter2 = null;
    var filter3 = null;

    const url = '../api/post/upload.php';
    var form = null;

    function startup() {

        input = document.getElementById('uploaded');
        uploadbutton = document.getElementById('upload');
        img = document.getElementById('output');

        // Get filter to merge it with the uploaded image

        filter1 = document.getElementById('filter1');
        filter2 = document.getElementById('filter2');
        filter3 = document.getElementById('filter3');

        form = document.querySelector('form');

        input.addEventListener('change', function (ev) {
            fileList = this.files;
            // this.form.image = event.target.files[0];
            // this.form.name = event.target.files[0].name;
            console.log(fileList);
            img.src = URL.createObjectURL(ev.target.files[0]);
            ev.preventDefault();
        }, false);


        filter1.addEventListener('click', function (ev) {
            console.log(filter1);
            console.log(filter1.value);
            lastFilter = filter1.value;
            uploadbutton.disabled = false;
          }, false);
      
          filter2.addEventListener('click', function (ev) {
            console.log(filter2);
            console.log(filter2.value);
            lastFilter = filter2.value;
            uploadbutton.disabled = false;
          }, false);
      
          filter3.addEventListener('click', function (ev) {
            console.log(filter3);
            console.log(filter3.value);
            lastFilter = filter3.value;
            uploadbutton.disabled = false;
          }, false);

        form.addEventListener('submit', function (ev) {
            send_file();
            ev.preventDefault();
        }, false);

    }

    function send_file() {
        const files = document.querySelector('[type=file]').files;
        const formData = new FormData();

        console.log("The last filter was ", lastFilter);

        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            formData.append('files[]', file);
        };

        formData.append("filter", lastFilter);

        console.log(formData.get('files[]'));

        if (formData.get('files[]'))
        {

            fetch("https://camagru-ik.cf/api/post/upload.php", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.text())
                .then((data) => {
                    if (data == '{"Message":"Image Uploaded"}') {
                        console.log('Image uploaded successfully');
                        window.location.href = '../redirect_pages/upload.php';
                    } else {
                        console.log(data);
                    }
    
                });
        }

        else {
            console.log("No image was uploaded");
        }

    }

    window.addEventListener('load', startup, false);
})();
