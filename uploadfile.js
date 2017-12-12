$(function () {
    $("#drop-box").click(function () {
        $("#upl").click();
    });
    // trigger the choose file button when clicked in the blue box

    // To prevent Browsers from opening the file when its dragged and dropped on to the page
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Add a listener to check if a file is chosen to trigger the upload action to call function fileUpload
    $('input[type=file]').on('change', fileUpload);
});

function fileUpload(event) {
    $("#drop-box").html("" + event.target.value + " uploading...");
    //to notify user the file is being uploaded
    files = event.target.files;
    // get the selected files
    var data = new FormData();
    // Form Data check the above bullet for what it is
    var error = 0;
    // Flag to notify in case of error and abort the upload

    // File data is presented as an array. In this case we can just jump to the index file using files[0] but this array traversal is recommended

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (!file.type.match('text.*')) {
            // Check for File type. the 'type' property is a string, it facilitates usage if match() function to do the matching
            $("#drop-box").html("Images only. Select another file");
            error = 1;
        } else if (file.size > 1048576) {
            // File size is provided in bytes
            $("#drop-box").html(" Too large Payload ( < 1 Mb). Select another file");
            error = 1;
        } else {
            // If all goes well, append the up-loadable file to FormData object
            data.append('text', file, file.name);
            // Comparing it to a standard form submission the 'image' will be name of input
        }
    }
    if (!error) {
        var xhr = new XMLHttpRequest();
        // Create a new XMLHttpRequest
        xhr.open('POST', 'read.php', true);
        // File Location, this is where the data will be posted
        xhr.send(data);
        xhr.onload = function () {
            // On Data send the following works
            if (xhr.status === 200) {
                $("#drop-box").html("File Uploaded.");
                }
                else {
                    $("#drop-box").html("Error in upload, try again.");
                    }
                };
            }
        }
