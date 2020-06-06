var url = "";

$(document).ready(function() {
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

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
                            swal("Success! The data has been updated!", {
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
    });
    
    $("#btn_approve").click(function (e) {
        e.preventDefault();
        swal({
            title: "Confirmation",
            text: "Are you sure approve the data?",
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
                var btn = $("#btn_approve");

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:"/admin/approve",
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data:{id:$("input[name='id']").val()},
                    success:function(response)
                    {
                        var text = '';
                        var res = JSON.parse(response);
                        if(res.status === 'true') {
                            swal("Success! The data has been approved!", {
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

    $("#btn_reject").click(function (e) {
        e.preventDefault();
        swal({
            title: "Confirmation",
            text: "Are you sure reject the data?",
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
                    var btn = $("#btn_reject");

                    var token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url:"/admin/reject",
                        method:"POST",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data:{id:$("input[name='id']").val()},
                        success:function(response)
                        {
                            var text = '';
                            var res = JSON.parse(response);
                            if(res.status === 'true') {
                                swal("Success! The data has been approved!", {
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

    $("#btn_delete").click(function (e) {
        e.preventDefault();
        swal({
            title: "Confirmation",
            text: "Are you sure delete the data?",
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
                var btn = $("#btn_delete");

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:"/admin/delete",
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data:{id:$("input[name='id']").val()},
                    success:function(response)
                    {
                        var text = '';
                        var res = JSON.parse(response);
                        if(res.status === 'true') {
                            swal("Success! The data has been deleted!", {
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

function change_file(){
    $("#div_edit_file").removeClass("show");
    $("#div_edit_file").addClass("hide");
    $("#div_new_file").removeClass("hide");
    $("#div_new_file").addClass("show");
}

function cancel_change_file() {
    $("#div_new_file").removeClass("show");
    $("#div_new_file").addClass("hide");
    $("#div_edit_file").removeClass("hide");
    $("#div_edit_file").addClass("show");
    var fileInput = document.getElementById('upload_file');
    fileInput.value = null;
}

function change_chapter_1(){
    $("#div_edit_chapter_1").removeClass("show");
    $("#div_edit_chapter_1").addClass("hide");
    $("#div_new_chapter_1").removeClass("hide");
    $("#div_new_chapter_1").addClass("show");
}

function cancel_change_chapter_1() {
    $("#div_new_chapter_1").removeClass("show");
    $("#div_new_chapter_1").addClass("hide");
    $("#div_edit_chapter_1").removeClass("hide");
    $("#div_edit_chapter_1").addClass("show");
    var fileInput = document.getElementById('chapter_1');
    fileInput.value = null;
}

function change_chapter_2(){
    $("#div_edit_chapter_2").removeClass("show");
    $("#div_edit_chapter_2").addClass("hide");
    $("#div_new_chapter_2").removeClass("hide");
    $("#div_new_chapter_2").addClass("show");
}

function cancel_change_chapter_2() {
    $("#div_new_chapter_2").removeClass("show");
    $("#div_new_chapter_2").addClass("hide");
    $("#div_edit_chapter_2").removeClass("hide");
    $("#div_edit_chapter_2").addClass("show");
    var fileInput = document.getElementById('chapter_2');
    fileInput.value = null;
}

function change_chapter_3(){
    $("#div_edit_chapter_3").removeClass("show");
    $("#div_edit_chapter_3").addClass("hide");
    $("#div_new_chapter_3").removeClass("hide");
    $("#div_new_chapter_3").addClass("show");
}

function cancel_change_chapter_3() {
    $("#div_new_chapter_3").removeClass("show");
    $("#div_new_chapter_3").addClass("hide");
    $("#div_edit_chapter_3").removeClass("hide");
    $("#div_edit_chapter_3").addClass("show");
    var fileInput = document.getElementById('chapter_3');
    fileInput.value = null;
}

function change_chapter_4(){
    $("#div_edit_chapter_4").removeClass("show");
    $("#div_edit_chapter_4").addClass("hide");
    $("#div_new_chapter_4").removeClass("hide");
    $("#div_new_chapter_4").addClass("show");
}

function cancel_change_chapter_4() {
    $("#div_new_chapter_4").removeClass("show");
    $("#div_new_chapter_4").addClass("hide");
    $("#div_edit_chapter_4").removeClass("hide");
    $("#div_edit_chapter_4").addClass("show");
    var fileInput = document.getElementById('chapter_4');
    fileInput.value = null;
}

function change_chapter_5(){
    $("#div_edit_chapter_5").removeClass("show");
    $("#div_edit_chapter_5").addClass("hide");
    $("#div_new_chapter_5").removeClass("hide");
    $("#div_new_chapter_5").addClass("show");
}

function cancel_change_chapter_5() {
    $("#div_new_chapter_5").removeClass("show");
    $("#div_new_chapter_5").addClass("hide");
    $("#div_edit_chapter_5").removeClass("hide");
    $("#div_edit_chapter_5").addClass("show");
    var fileInput = document.getElementById('chapter_5');
    fileInput.value = null;
}