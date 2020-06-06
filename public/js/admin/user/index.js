$(document).ready(function() {
    $("#btn_update_user").click(function (e) {
        e.preventDefault();
        swal({
            title: "Confirmation",
            text: "Are you sure update the status?",
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

                var btn = $(this);

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:'/admin/user/update-status',
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data:{email:$("#hdn_email").val(),status:$('input[name="status"]:checked').val()},

                    success:function(response)
                    {
                        var text = '';
                        var res = JSON.parse(response);
                        if(res.status == 'true') {
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
    })
    
    $("#btn_change_password").click(function (e) {
        e.preventDefault();
        swal({
            title: "Confirmation",
            text: "Are you sure update the password?",
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

                var btn = $(this);

                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url:'/admin/user/change-password',
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data:$("#form_password").serialize(),

                    success:function(response)
                    {
                        var text = '';
                        var res = JSON.parse(response);
                        if(res.status === 'true') {
                            swal("Success! Password has been updated!", {
                                icon: "success",
                            });
                            window.location = "/admin/user/all"
                        }else{
                            swal(res.message, {
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

function edit_user(email,status) {
    if(status == 'active'){
        $("#radio_active").attr('disabled','disabled');
        $("#radio_reject").attr('disabled','disabled');
        $("#radio_block").attr('checked','checked');
        $("#div_unblock").css('display','none');
        $("#div_block").css('display','block');
    }else if(status=='inactive' ){
        $("#radio_active").removeAttr('disabled');
        $("#radio_reject").removeAttr('disabled');
        $("#radio_block").removeAttr('checked');
        $("#radio_active").prop("checked", true);
        $("#div_unblock").css('display','none');
        $("#div_block").css('display','block');
    }else if(status=='blocked'){
        $("#radio_active").attr('disabled','disabled');
        $("#radio_reject").attr('disabled','disabled');
        $("#div_block").css('display','none');
        $("#div_unblock").css('display','block');
        $("#radio_unblock").prop("checked", true);
    }else if(status=='rejected'){
        $("#radio_active").removeAttr('disabled');
        $("#radio_reject").attr('disabled','disabled');
        $("#radio_block").removeAttr('checked');
        $("#radio_active").prop("checked", true);
        $("#div_unblock").css('display','none');
        $("#div_block").css('display','block');
    }

    $("#hdn_email").val(email);
    $("#modal_edit_user").modal("show");
}

function init_table_user_all(status) {
    let url = {
        all: "/admin/user/all/paging",
        rejected : "/admin/user/rejected/paging",
        inactive:  "/admin/user/pending/paging"
    };
    let table = $('#dt_user');
    if (table != null) {
        table.DataTable({
            responsive: {
                details: {
                    renderer: function ( api, rowIdx, columns ) {
                        var data = $.map( columns, function ( col, i ) {
                            return col.hidden ?
                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                                '</tr>' :
                                '';
                        } ).join('');

                        return data ?
                            $('<table/>').append( data ) :
                            false;
                    }
                }
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: url[status],
                type:"POST",
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('meta[name="csrf-token"]').attr('content');
                }
            },
            columns: [
                { defaultContent: '<td></td>' },
                { data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email'},
                { data: 'role', name: 'role'},
                { data: 'identity_number', name: 'identity_number'},
                { data: 'profession', name: 'profession'},
                { data: 'created_at', name: 'created_at'},
                { data: 'approved_date', name: 'approved_date'},
                { data: 'approved_by', name: 'approved_by'},
                { data: 'last_login_at', name: 'last_login_at'},
                { data: 'last_login_ip', name: 'last_login_ip'},
                { data: 'status', name: 'status'},
                { defaultContent: '<td></td>' },
            ],
            columnDefs: [
                {
                    targets: 1,
                    className: "text-center"
                },
                {
                    targets: 2,
                    render: function(data, type, full, meta) {
                        return data.length > 45 ?
                            data.substr( 0, 45 ) +'…' :
                            data;
                    }
                },
                {
                    targets: 3,
                    render: function(data, type, full, meta) {
                        return data.length > 45 ?
                            data.substr( 0, 45 ) +'…' :
                            data;
                    }
                },
                {
                    targets:7,
                    render:function (data,type,full,meta) {
                        let tanggal = new Date(data);
                        return tanggal.getFullYear()+"-"
                            + (tanggal.getMonth()+ 1 > 9 ? (tanggal.getMonth()+ 1).toString() : "0" + (tanggal.getMonth()+ 1).toString())
                            +"-"
                            +(tanggal.getDate() > 9 ? tanggal.getDate().toString() : "0" + tanggal.getDate().toString())
                            + " "
                            +(tanggal.getUTCHours().toString() > 9 ? tanggal.getUTCHours().toString() : "0" + tanggal.getUTCHours().toString())
                            + ":" + (tanggal.getUTCMinutes().toString() > 9 ? tanggal.getUTCMinutes().toString() : "0" + tanggal.getUTCMinutes().toString())
                            + ":" + (tanggal.getUTCSeconds().toString() > 9 ? tanggal.getUTCSeconds().toString() : "0" + tanggal.getUTCSeconds().toString());
                    }
                },
                {
                    targets: 12,
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        var row_status = {
                            active: "success",
                            blocked : "danger",
                            inactive:  "warning",
                            deleted : "dark",
                            rejected : "dark"
                        };

                        if (typeof row_status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="badge badge-' + row_status[data] + '">'+data+'</span>';
                    },
                },
                {
                    targets:13,
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        if(full.status !== 'deleted' && full.status !== 'inactive' && full.status !== 'rejected'){
                            return '<a href="javascript:void(0)" class="btn btn-datatable btn-icon btn-transparent-dark btn-sm p-0 mr-1" onclick="edit_user(\''+full.email+'\',\''+full.status+'\')"><i class="fas fa-edit"></i></a><a href="javascript:void(0)" onclick="change_password(\''+full.email+'\')" class="btn btn-datatable btn-icon btn-transparent-dark btn-sm p-0"><i class="fas fa-key"></i></a>';
                        }else if(full.status === 'inactive' || full.status === 'rejected'){
                            return '<a href="javascript:void(0)" class="btn btn-datatable btn-icon btn-transparent-dark btn-sm p-0" onclick="edit_user(\''+full.email+'\',\''+full.status+'\')"><i class="fas fa-edit"></i></a>';
                        }
                    },
                }
            ],
        });
    }
}
