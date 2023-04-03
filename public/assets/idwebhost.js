$('#CatTable_wrapper').css("margin-top", "70px");
/*======= Cut cell Option (Edit/delete)==========*/
/*var CellCount = document.getElementById("CatTable").rows[0].cells.length;
var TotalCell = (CellCount*1)-1;
var TotalsCell = $.map($(Array(TotalCell)),function(val, i) { return i; });*/
/*======= Add DataTable=============*/
$('#CatTable').DataTable( {
        "order": [
                [0, 'asc']
            ],
             "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Jumlah _START_ dari _END_ of _TOTAL_ Halaman",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total Perbaris)",
                "lengthMenu": "_MENU_",
                "search": "Cari : ",
                "zeroRecords": "No matching records found"
            },
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 20,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        responsive: false,
        /*=====Button export Config =====================*/
        buttons: [

                { extend: '', className: 'btn red btn-outline addNew', text: 'Tambah Baru'},
                { extend: 'print', className: 'btn btn-default btn-outline',text:'<i class="fa fa-print" aria-hidden="true"></i>', 
                    exportOptions: {
                      columns: [0,1,2]
                    } 
                },
                { extend: 'copy', className: 'btn btn-default btn-outline',text:'<i class="fa fa-files-o" aria-hidden="true"></i>' },
                { 
                    extend: "pdfHtml5",
                    className: "btn btn-default btn-outline",
                    text:'<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                    footer: true, 
                    exportOptions: {
                      columns: [0,1,2]
                    }, 
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                       customize: function (doc) {

                           doc.content[1].table.widths = '17%';
                            var tblBody = doc.content[1].table.body;
                                for(var i=0;i<tblBody[0].length;i++){
                                  tblBody[0][i].fillColor = '#FFFFFF';
                                  tblBody[0][i].color = 'black';
                                }
                            var now = new Date();
                            var jsDate = now.toGMTString();
                            doc['footer']=(function(page, pages) {
                                            return [
                                            {canvas: [ { type: 'line', x1: 30, y1: 15, x2: 595-30, y2: 15, lineWidth: 1,color:'black' } ]},
                                            {
                                            columns: [
                 
                                                     {
                                                        alignment: 'left',
                                                        fontSize:'7',
                                                        text: ['Version: 1.0'],
                                                    },
                                                    {
                                                        alignment: 'center',
                                                        fontSize:'7',
                                                        text: ['page ', { text: page.toString() }]
                                                    },
                                                    {
                                                        alignment: 'right',
                                                        fontSize:'7',
                                                        text: ['Generated on: ', { text: jsDate}]
                                                    },
                                            
                                                ],
                                                margin: [30,15,30,35]
                                            },
                                            ]
                                        });
                 
                                        var objLayout = {};
                                        objLayout['hLineWidth'] = function(i) { return .5; };
                                        objLayout['vLineWidth'] = function(i) { return .5; };
                                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                                        objLayout['paddingLeft'] = function(i) { return 4; };
                                        objLayout['paddingRight'] = function(i) { return 4; };
                                        doc.content[1].layout = objLayout;
                                        var obj = {};
                                        obj['hLineWidth'] =  function(i) { return .5; };
                                        obj['hLineColor'] = function(i) { return '#aaa'; };
                                        doc.content[1].margin = [ 0, 0, 150, 0 ];
                                         doc.content[1].table.widths = '20%';
                            }
                },
                { extend: 'excel', className: 'btn btn-default btn-outline',text:'<i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                    exportOptions: {columns: [0,1,2]} 
                },
                { extend: '', className: 'btn red btn-outline Periode', text: 'Periode'},
            ]
    });
/*============Add Function close modal=============*/
$("body").on("click","#bt-close", function(){
    $("#modal-id").hide();
    $("div#md-body").html('');
    $("#md-title").html("");
});
/*========Delete All========*/
$("body").on("click","#delete_id", function(){
    var id     = $(this).attr("data-id");
    var title  = $(this).attr("data-title");
    var tbl    = $(this).attr("data-tbl");
    var iduser = $(this).attr("data-iduser");
    var deleteUrl = $(this).attr("data-delete");
    var token = $("meta[name='csrf-token']").attr("content");
    $("#modal-id").show();
    $("div#md-body").html('Are you sure delete this row ?');
    $("#md-title").html('Notif delete '+title);  
    $("#save_data").addClass('delete_row'+id);
    $('body').on("click","input.delete_row"+id, function(){
        var kirim = [tbl,iduser,id];
        $.ajax({
             type: 'POST', 
             url: deleteUrl,
             dataType: "JSON",
             cache: false,
             data: {
                        "tbl": tbl,
                        "iduser": iduser,
                        "id": id,
                        "_token": token
                    },
             success : function(data) {
               $("#tr"+id).remove();
             }
          });   
      });  
}); 
