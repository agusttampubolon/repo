var url = "";
var url_revision = "";

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
        Swal.fire({
            title: "Confirmation",
            text: "Are you sure submit the data?",
            showCancelButton: true,
            confirmButtonColor: '#2f4e4f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change now!'
        })
        .then((value) => {
            if (value) {
                loading();
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
                            Swal.fire("Success! The data has been updated!", {
                                icon: "success",
                            });
                            location.reload();
                        }else{
                                Swal.fire("Error! Something went wrong!", {
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
                            Swal.fire({
                                text:"Success! The data has been approved!",
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            Swal.fire({
                                text:"Error! Something went wrong!",
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
        $("#modal_rejection").modal('show');
    });

    $("#btn_revision").click(function (e) {
        $("#modal_revision").modal('show');
    });

    $("#btn_rejection").click(function (e) {
        e.preventDefault();
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
                    var btn = $("#btn_rejection");

                    var token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url:"/admin/reject",
                        method:"POST",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        //data:{id:$("input[name='id']").val(),notes:$("input[name='notes']").val()},
                        data:$("#form_rejection").serialize(),
                        success:function(response)
                        {
                            var text = '';
                            var res = JSON.parse(response);
                            if(res.status === 'true') {
                                Swal.fire({
                                    text:"Success! The data has been approved!",
                                    icon: "success",
                                });
                                location.reload();
                            }else{
                                Swal.fire({
                                    text: "Error! Something went wrong!",
                                    icon: "error",
                                });
                                btn.removeAttr("disabled");
                            }
                        }
                    })
                }
            });
    })

    $("#btn_submit_revision").click(function (e) {
        e.preventDefault();
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
                var btn = $("#btn_submit_revision");

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:"/admin/revision",
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    //data:{id:$("input[name='id']").val(),notes:$("input[name='notes']").val()},
                    data:$("#form_revision").serialize(),
                    success:function(response)
                    {
                        var text = '';
                        var res = JSON.parse(response);
                        if(res.status === 'true') {
                            Swal.fire({
                                text:"Success! The data has been approved!",
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            $.each(res.message, function( index, value ) {
                                text += value[0]+'<br/>';
                            });
                            Swal.fire({
                                html: text,
                                icon: "error",
                            });
                            btn.removeAttr("disabled");
                        }
                    }
                })
            }
        });
    });

    $('#form_submit_user_revision').on('submit', function(event) {
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
                var btn = $("#btn_revise_user");

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: url_revision,
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
                                text:"Success! The data has been approved!",
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            $.each(res.message, function( index, value ) {
                                text += value[0]+'<br/>';
                            });
                            Swal.fire({
                                html: text,
                                icon: "error",
                            });
                            btn.removeAttr("disabled");
                        }
                    }
                })
            }
        });
    });

    $("#btn_delete").click(function (e) {
        e.preventDefault();
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
                            Swal.fire({
                                text:"Success! The data has been approved!",
                                icon: "success",
                            });
                            location.reload();
                        }else{
                            Swal.fire({
                                text:"Error! Something went wrong!",
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

function change_cover_pdf(){
    $("#div_edit_cover_pdf").removeClass("show");
    $("#div_edit_cover_pdf").addClass("hide");
    $("#div_new_cover_pdf").removeClass("hide");
    $("#div_new_cover_pdf").addClass("show");
}

function cancel_change_cover_pdf() {
    $("#div_new_cover_pdf").removeClass("show");
    $("#div_new_cover_pdf").addClass("hide");
    $("#div_edit_cover_pdf").removeClass("hide");
    $("#div_edit_cover_pdf").addClass("show");
    var fileInput = document.getElementById('cover_pdf');
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

function change_reference(){
    $("#div_edit_reference").removeClass("show");
    $("#div_edit_reference").addClass("hide");
    $("#div_new_reference").removeClass("hide");
    $("#div_new_reference").addClass("show");
}

function cancel_change_reference() {
    $("#div_new_reference").removeClass("show");
    $("#div_new_reference").addClass("hide");
    $("#div_edit_reference").removeClass("hide");
    $("#div_edit_reference").addClass("show");
    var fileInput = document.getElementById('reference');
    fileInput.value = null;
}

function change_appendix(){
    $("#div_edit_appendix").removeClass("show");
    $("#div_edit_appendix").addClass("hide");
    $("#div_new_appendix").removeClass("hide");
    $("#div_new_appendix").addClass("show");
}

function cancel_change_appendix() {
    $("#div_new_appendix").removeClass("show");
    $("#div_new_appendix").addClass("hide");
    $("#div_edit_appendix").removeClass("hide");
    $("#div_edit_appendix").addClass("show");
    var fileInput = document.getElementById('appendix');
    fileInput.value = null;
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