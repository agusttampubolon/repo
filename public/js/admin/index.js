function init_data_table(types) {
    var url = {
        article: "/admin/article/user/",
        paper: "/admin/student-paper/user/",
    };

    let table = $('#dt_user_submitted');

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
                url: url[types]+'paging',
                type:"POST",
                data: function ( d ) {
                    d.myKey = "myValue";
                    d._token = $('meta[name="csrf-token"]').attr('content');
                    d.type = types;
                    d.filter = $('input[name="filter"]').val();
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
                { data: 'count', name: 'count'},
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
                    className: "text-center"
                },
                {
                    targets: 13,
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
                    targets:14,
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        let url_view = url[types] + full.id;
                        return '<a href="'+ url_view +'" class="btn btn-datatable btn-icon btn-transparent-dark btn-sm p-0"><i class="fas fa-eye"></i></a>';
                    },
                }
            ],
        });
    }
}