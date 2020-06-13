$(document).ready(function() {

});

function init_data_table(status) {
    let url = {
        all: "/admin/monograph/all/paging",
    };
    let table = $('#dt_monograph');
    if (table != null) {
        table.DataTable({
            order:[8,'desc'],
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
                { data: 'title', name: 'title' },
                { data: 'author_1', name: 'author_1'},
                { data: 'publisher', name: 'publisher'},
                { data: 'publication_place', name: 'publication_place'},
                { data: 'issued_date', name: 'issued_date'},
                { data: 'upload_file', name: 'upload_file'},
                { data: 'created_at', name: 'created_at'},
                { data: 'created_by', name: 'created_by'},
                { data: 'row_status', name: 'row_status'},
                { data: 'id', name: 'id'},
            ],
            columnDefs: [
                {
                    targets: 0,
                    className: "text-center"
                },
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
                    targets: 7,
                    render: function(data, type, full, meta) {
                        return '<a href="/assets/upload/monograph/'+full.code+'/'+data+'" target="_blank">'+data+'</a>';
                    }
                },
                {
                    targets:8,
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
                    targets: 10,
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        var row_status = {
                            active: "success",
                            blocked : "danger",
                            pending:  "warning",
                            deleted : "dark",
                            rejected : "dark"
                        };

                        if (typeof row_status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="badge badge-' + row_status[data] + '">'+data.toUpperCase()+'</span>';
                    },
                },
                {
                    targets: 11,
                    className: "text-center",
                    render: function(data, type, full, meta) {
                        return '<a href="/admin/monograph/edit/'+data+'" class="btn btn-datatable btn-icon btn-transparent-dark btn-sm p-0 mr-2"><i class="fas fa-edit"></i></a>' +
                            '<a target="_blank" href="/detail/'+full.code+'" class="btn btn-datatable btn-icon btn-transparent-dark btn-sm p-0"><i class="fas fa-eye"></i></a>';
                    },
                }
            ],
        });
    }
}
