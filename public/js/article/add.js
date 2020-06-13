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
        Swal.fire({
            title: "Confirmation",
            text: "Are you sure submit the data?",
            showCancelButton: true,
            confirmButtonColor: '#2f4e4f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change now!'
        })
        .then((result) => {
            if (result.value) {
                loading();
                var btn = $("#btn_save_article");

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:'/article/submit',
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
                            Swal.fire({
                                text: "Success! The data has been submitted!",
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            Swal.fire({
                                "title": "",
                                "text": "Error! Something went wrong!",
                                "type": "error",
                                confirmButtonColor: '#2f4e4f',
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

function loading() {
    Swal.fire({
        text: "please wait ...",
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: false,
        closeOnEsc: false,
    });
}