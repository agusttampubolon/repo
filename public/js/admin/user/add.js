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

$(document).ready(function() {
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
                    url:"/admin/user/submit",
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
                            swal("Success! The data has been created!", {
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            var text = '';
                            $.each(res.message, function( index, value ) {
                                text += value[0];
                            });
                            swal({
                                text:text,
                                icon: "error",
                            });
                            btn.removeAttr("disabled");
                        }
                    }
                })
            }
        });
    });
});