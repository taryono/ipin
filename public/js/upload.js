$(document).ready(function () {
    $("#file").change(function () {
        readURL(this);
    });
    $("body").on("click", "button#upload_file_submit", function (e) {
        e.preventDefault();
        var formData = new FormData($('form.form-upload')[0]);
        $('.msg').hide();
        $('.upload_message').hide();
        $('.progress').show();
        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
                    }
                });
                return xhr;
            },
            type: 'POST',
            url: $('form.form-upload').attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (e) {   
                $($('form.form-upload'))[0].reset();
                $('.progress').hide();
                $('.msg').show();
                var obj = JSON.parse(e);
                $('.msg').html(obj.msg);
                get_data(); 
            },
            error: function (e) {  
                $('.msg').html(e);
            }
        });
    }).on('click', 'button.cancel-upload', function (e) {
        e.preventDefault();
        $('.msg').hide();
        $('.upload_message').hide(); 
        $("button.close").click();
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var size = input.files[0].size;
        var extensions = ["pdf"];
        if (extensions.indexOf(getFileExtension(input.files[0].name.toLowerCase())) != -1)
        { 
            if (size > 15360000){ 
                $('.upload_message').show();
                $('.upload_message').html('Ukuran file: ('+(Math.round(size /1024))+') terlalu besar');
                $("#file").val("");
            }else{
                $('.upload_message').hide();
                $("button#upload_file_submit").removeClass("disabled");
            }
        } else { 
             $("button#upload_file_submit").addClass("disabled");
            $('.upload_message').show();
            $('.upload_message').html('Tipe file :'+input.files[0].name.toLowerCase()+' tidak diijinkan.');
            $("#file").val("");
        }
    }
}

function getFileExtension(filename) {
    return filename.split('.').pop();
}