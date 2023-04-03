<form id="formReg" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" >     
<div class="form-group default">
    <label class="control-label col-md-3">Category Name<span class="required">
    * </span>
    </label>
    <div class="col-md-4">
        <input type="text" name="name" class="form-control" placeholder="Nama" required>
    </div>
</div>


<div class="form-group">
    <label class="control-label col-md-3">Publish <span class="required">
    * </span>
    </label>
    <div class="col-md-4">
        <select class="form-control select2me" name="is_publish">
            <option value="">Change Publish</option>
            <option value="1" selected>Show</option>
            <option value="2">Hide</option>
             
        </select>
    </div>
</div>

<div class="form-actions">
    <input type="submit" class="btn purple" id="simpan_data" value="Save Category Data">
</div>
</form> 
<script>
$(document).ready(function() {
    var token = "{{ csrf_token() }}";
    $('body').on('submit','#formReg',function(event){
          var over = '<div id="overlay">' +
                       '<img id="loading" src="{{ asset('assets/ajax-loader.gif')}}" >' +
                       '</div>';
          $(over).appendTo('div.modal-dialog');
          event.preventDefault();
          var formData = new FormData($(this)[0]);
          formData.append('_token', token);
          $.ajax({
              url : "{{url('category_insert')}}", 
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function (returndata) {
                console.log(returndata);
                  var footerr = $("<button type='button' id='bckTbl' class='btn btn-default'>Tutup Panel</button>");
                  $('#overlay').html("");
                  $('#overlay').remove();
                  $("#getmodal").modal('show');
                  $('.modal-body').html("Simpan data Berhasil ");
                  $('.modal-title').html("Notif");
                  $(".modal-footer").html(footerr);
                  $("body").on('click','#bckTbl',function (){
                    location.reload();
                  });
              }
           });
        });
    });
</script>
