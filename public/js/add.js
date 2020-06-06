var url = "";

$(document).ready(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $('#form_submit').on('submit', function(event) {
        event.preventDefault();
        swal({
            title: "Confirmation",
            text: "Are you sure submit the data?",
            buttons: true,
            dangerMode: true,
        })
        .then((value) => {
            if (value) {
                swal({
                    text: "please wait ...",
                    button: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                });
                var btn = $("#btn_save");

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:url,
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        var text = '';
                        var res = JSON.parse(response);
                        if(res.status === 'true') {
                            swal("Success! The data has been submitted!", {
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            swal("Error! Something went wrong!", {
                                icon: "error",
                            });
                            btn.removeAttr("disabled");
                        }
                    }
                })
            }
        });
    })
});


function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("customFile").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
    };
}