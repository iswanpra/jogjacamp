<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/custom.css') }}" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/datatables.min.js') }}" type="text/javascript"></script>

<div class="container">
<table class="table table-hover" id="CatTable">
    <thead>
      <tr>
        <th>no</th>
        <th>Nama Instansi</th>
        <th>Publish </th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
        @foreach($dataTable as $key=> $row)
        <tr id="tr{{ $row->id }}">
          <td>{{ $key+1 }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->is_publish }}</td>
          <td>
            <a data-id="{{ $row->id }}" id="edit" class="btn btn-default">
              <i class="fa fa-eye"></i>&nbsp;Edit
            </a>
            <button id="del" class="btn btn-danger" data-id="{{ $row->id }}">
              <i class="fa fa-trash-alt"></i>&nbsp;Hapus
            </button>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>  
<!-- Modal form -->
<div class="modal fade" id="getmodal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal" type="button" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" type="button">Simpan</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#CatTable_wrapper').css("margin-top", "70px");
/*======= Cut cell Option (Edit/delete)==========*/
var CellCount = document.getElementById("CatTable").rows[0].cells.length;
var TotalCell = (CellCount*1)-1;
var TotalsCell = $.map($(Array(TotalCell)),function(val, i) { return i; });
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
    responsive: true,
        /*=====Button export Config =====================*/
    buttons: [

            { extend: '', className: 'btn red btn-outline addNew', text: 'Tambah Baru'},
            { extend: 'print', className: 'btn btn-default btn-outline',text:'<i class="fa fa-print" aria-hidden="true"></i>', 
                exportOptions: {
                  columns: TotalsCell
                } 
            },
            { extend: 'copy', className: 'btn btn-default btn-outline',text:'<i class="fa fa-files-o" aria-hidden="true"></i>' },
            { 
                extend: "pdfHtml5",
                className: "btn btn-default btn-outline",
                text:'<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                footer: true, 
                exportOptions: {
                  columns: TotalsCell
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
                exportOptions: {columns: TotalsCell} 
            },
        ]
    });
/*=======Add New Form============*/
$("body").on("click",".addNew", function(){
	var token = "{{ csrf_token() }}";
	$("#getmodal").modal('show');
	$(".modal-dialog").css("width","75%");
	$(".modal-dialog").css("height","outo");
	$(".modal-dialog").css("padding","0");
	//modal-content
	$(".modal-content").css("border-radius","0%");
	$(".modal-content").css("height","outo");
	var footerr = $("Form Input Sejarah");
	$(".modal-footer").html(footerr);
	$.ajax({
		 type: 'POST', 
		 url : "{{url('FormController/form_categori')}}",
		 data : "_token="+token,
		 success : function(data) {
		   $(".modal-body").html(data);
		  
		 }
	});                
	$(".modal-title").html("Add New Category");
});
/*=======Edit Data=====================*/
$("body").on("click","#edit", function(){
    var token = "{{ csrf_token() }}";
    var id    = $(this).attr("data-id");
    $("#getmodal").modal('show');
    $(".modal-dialog").css("width","75%");
    $(".modal-dialog").css("height","outo");
    $(".modal-dialog").css("padding","0");
    //modal-content
    $(".modal-content").css("border-radius","0%");
    $(".modal-content").css("height","outo");
    var footerr = $("Form Input Sejarah");
    $(".modal-footer").html(footerr);
    $.ajax({
         type: 'GET', 
         url : "{{url('FormController/form_edit_categori')}}/"+id,
         data: {
                "categori_id": id,
                "_token": token
            },
         success : function(data) {
           $(".modal-body").html(data);
          
         }
    });                
    $(".modal-title").html("Add New Category");
});
/*==========Delete Data ===================*/
$("body").on("click","#del" , function(){
      var id = $(this).attr("data-id");
      $("#getmodal").modal({backdrop: 'static', keyboard: false});
      var footer = '<button type="button" id="save'+id+'" class="btn blue" data-dismiss="modal">Yes</button>'+
               '<button type="button" class="btn default" data-dismiss="modal">No</button>';
      $(".modal-title").html("Notif");
      $(".modal-body").html("Are you sure delete This data ???");
      $(".modal-footer").html(footer);  
      $('body').on("click","#save"+id, function(){
        $.ajax({
             type: 'get', 
             url : "{{url('hapus_list')}}/"+id,
             data : "getitem="+id,
             success : function(data) {
               $("#tr"+id).remove();
             }
          });   
      });
    });
</script>

