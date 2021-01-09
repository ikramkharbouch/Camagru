// This is an anonymous function
(function () {

    var input = null;
    var uploadbutton = null;

    var image = null;
    var fileList = null;

    const url = '../api/post/upload.php';
    var form = null;

    function startup() {

        input = document.getElementById('uploaded');
        uploadbutton = document.getElementById('upload');
        img = document.getElementById('output');

        form = document.querySelector('form');

        input.addEventListener('change', function (ev) {
            fileList = this.files;
            // this.form.image = event.target.files[0];
            // this.form.name = event.target.files[0].name;
            console.log(fileList);
            img.src = URL.createObjectURL(event.target.files[0]);
            ev.preventDefault();
        }, false);


        // uploadbutton.addEventListener('click', function(ev) {
        //     send_img();
        //     ev.preventDefault();
        // }, false);

        form.addEventListener('submit', function (ev) {
            send_file();
            ev.preventDefault();
        }, false);

    }

    function send_file() {
        const files = document.querySelector('[type=file]').files;
        const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];

            formData.append('files[]', file);
        };

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

    function send_img() {

        form.append('image', fileList);
        form.append('name', fileList.name); // [edited]

        console.log(fileList.name);
        console.log(fileList);

        fetch("https://camagru-ik.cf/api/post/upload.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ form }),
        })
            .then((res) => res.text())
            .then((data) => {
                if (data == '{"Message":"Image Uploaded"}') {
                    console.log('Image uploaded successfully');
                } else {
                    console.log(data);
                }

            });

        console.log(fileList);
        console.log(1);

    }

    // A function to check the type of the file

    function getMetadataForFileList(fileList) {
        for (const file of fileList) {
            // Not supported in Safari for iOS.
            const name = file.name ? file.name : 'NOT SUPPORTED';
            // Not supported in Firefox for Android or Opera for Android.
            const type = file.type ? file.type : 'NOT SUPPORTED';
            // Unknown cross-browser support.
            const size = file.size ? file.size : 'NOT SUPPORTED';
            console.log({ file, name, type, size });
        }
    }

    window.addEventListener('load', startup, false);
})();
