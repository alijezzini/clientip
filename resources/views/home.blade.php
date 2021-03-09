@extends('layouts.admin')

@section('content')
<style>
#overlay,#overlayDelete,#overlayEdit {
  background: #ffffff;
  color: #666666;
  position: fixed;
  height: 100%;
  width: 100%;
  z-index: 5000;
  top: 0;
  left: 0;
  float: left;
  text-align: center;
  padding-top: 25%;
  opacity: .80;
}
.spinner {
    margin: 0 auto;
    height: 64px;
    width: 64px;
    animation: rotate 0.8s infinite linear;
    border: 5px solid #0055FF;
    border-right-color: transparent;
    border-radius: 50%;
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
<div class="container">
<div id="overlayDelete" style="display:none;">
    <div class="spinner"></div>
    <br/>
    Deleting...
</div>
<div class="row pb-4">
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <form id="AddForm" method="post" action="submitip" >
  @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="myModalLabel">Add</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div class="form-group"><label for="note"><b>Name</b></label><input type="text" class="form-control" id="name" name="name" required></div>
            <div class="form-group"><label for="note"><b>IPs</b></label><textarea class="form-control" type="text" id="ip" name="ip" rows="5" required></textarea></div>
            <div class="form-group"><label for="note"><b>Type</b></label><br>
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="type" id="SMPP" value="SMPP" required>
  <label class="form-check-label" for="SMPP">SMPP</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="type" id="HTTP" value="HTTP" required>
  <label class="form-check-label" for="HTTP">HTTP</label>
</div>
</div>
            <div class="form-group"><label for="note"><b>Gateway</b></label><br>
            <div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="UK" value="UK/GR" required>
  <label class="form-check-label" for="UK">UK/GR</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="Nigeria" value="Nigeria" required>
  <label class="form-check-label" for="Nigeria">Nigeria</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="HongKong" value="HongKong" required>
  <label class="form-check-label" for="HongKong">HongKong</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="Pakistan" value="Pakistan" required>
  <label class="form-check-label" for="Pakistan">Pakistan</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="Enterprise" value="Enterprise" required>
  <label class="form-check-label" for="Enterprise">Enterprise</label>
</div>
</div>
<div id="alertmsg1" class="alert alert-danger" role="alert" style="display:none">
  Please select at least one Gateway!
</div>            
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button id="myFormSubmit" class="btn btn-success" type="submit">Add</button>
            </div>
        </div>
    </div>
 </form>
</div>


<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalAddLabel" aria-hidden="true">
  <form id="EditForm" method="post" action="editip">
  @csrf
  <input type="hidden" id="cl_id" name="cl_id" value="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="myModalLabel">Edit</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div class="form-group"><label for="editname"><b>Name</b></label><input type="text" class="form-control" id="editname" name="name"></div>
            <div class="form-group"><label for="editip"><b>IPs</b></label><textarea class="form-control" type="text" id="editip" name="ip" rows="5"></textarea></div>
            <div class="form-group"><label for="note"><b>Type</b></label><br>
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="type" id="editSMPP" value="SMPP">
  <label class="form-check-label" for="editSMPP">SMPP</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="type" id="editHTTP" value="HTTP">
  <label class="form-check-label" for="editHTTP">HTTP</label>
</div>
</div>
            <div class="form-group"><label><b>Gateway</b></label><br>
            <div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="editUK" value="UK/GR" required>
  <label class="form-check-label" for="editUK">UK/GR</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="editNigeria" value="Nigeria" required>
  <label class="form-check-label" for="editNigeria">Nigeria</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="editHongKong" value="HongKong" required>
  <label class="form-check-label" for="editHongKong">HongKong</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="editPakistan" value="Pakistan" required>
  <label class="form-check-label" for="editPakistan">Pakistan</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="gateway" type="radio" id="editEnterprise" value="Enterprise" required>
  <label class="form-check-label" for="editEnterprise">Enterprise</label>
</div>

</div>
<div id="alertmsg2" class="alert alert-danger" role="alert" style="display:none">
  Please select at least one Gateway!
</div> 
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button id="myFormSubmit" class="btn btn-success" type="submit">Edit</button>
            </div>
        </div>
    </div>
 </form>
</div>

<div class="col-md-12 py-2">
               <div class="flash-message">
                  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))

                       <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                     @endif
                   @endforeach
                 </div>
            </div>
    <div class="col-md-12" style="color:green"><span id="addspan" style="cursor:pointer"><b><i class="fas fa-plus"></i> Add</b></span></div>    
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <td><input type="checkbox" id="checkAll"></td>
                <th>Name</th>
                <th>IP</th>
                <th>Type</th>
                <th>Gateway</th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
		@if (count($ips) == 0)
        <tr>
            <td colspan="6" style="text-align:center">No IPs to display.</td>
        </tr>
        @endif
            @foreach ($ips as $ip)
            <tr id='tr_{{$ip->id}}'>
            <td><input type='checkbox' class="checkbox" data-id="{{$ip->id}}" ></td>
            <td>{{ $ip->name }}</td>
            <td>{{ $ip->ip }}</td>
            <td>{{ $ip->type}}</td>
            <td>{{ $ip->gateway }}</td>
            <td style="text-align:right"><div class="btn-group">
                    <i class="fas fa-edit icon-edit" data-val="{{$ip->id}}" style="margin-right:5px;color:green;cursor:pointer;font-size:18pt"></i>
</div></td>
        </tr>
        @endforeach
            
        </tbody>
    </table>
                
                
                
                </div>
</div>
</div>
<script>

$(document).ready(function() { 

    $('#example tbody').on( 'click', '.icon-edit', function () {
     
     
     var cl_id=$(this).data('val');
     var name = $(this).closest('tr').find('td:eq(1)').text();
     var ip = $(this).closest('tr').find('td:eq(2)').text();
     var type = $(this).closest('tr').find('td:eq(3)').text();
     var gateway = $(this).closest('tr').find('td:eq(4)').text();
     $("#cl_id").val(cl_id);
     $("#editname").val(name);
     $("#editip").val(ip);
        if(type=="HTTP"){
            $("#editSMPP").prop('checked', false);
            $("#editHTTP").prop('checked', true);
            
        }
        else if(type=="SMPP"){
            $("#editHTTP").prop('checked', false);
            $("#editSMPP").prop('checked', 'checked');
        }
        $("#alertmsg2").css('display', 'none');
        $("#editUK").prop('checked', false);
        $("#editGR").prop('checked', false);
        $("#editNigeria").prop('checked', false);
        $("#editHongKong").prop('checked', false);
        $("#editPakistan").prop('checked', false);
        $("#editEnterprise").prop('checked', false);
        var res = gateway.split("/");

        var i;
            for (i = 0; i < res.length; i++) {
                switch (res[i]) {
                case "UK":
                    $("#editUK").prop('checked', true);
                    break;
                case "GR":
                    $("#editGR").prop('checked', true);
                    break;
                case "Nigeria":
                    $("#editNigeria").prop('checked', true);
                    break;
                case "HongKong":
                    $("#editHongKong").prop('checked', true);
                    break;
                case "Pakistan":
                    $("#editPakistan").prop('checked', true);
                    break;
                case "Enterprise":
                    $("#editEnterprise").prop('checked', true);
                }
            }
     $('#ModalEdit').modal('show');
     
 } );

    $('#addspan').on( 'click', function () {
      $("#alertmsg1").css('display', 'none');
        $('#ModalAdd').modal('show');
       
    });
    
    var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
            "scrollX": true,
            dom: 'lfr<"toolbar">tip',
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            fnInitComplete: function(){
           $('div.toolbar').html('<span id="delete" style="color:#ef3535;cursor:pointer;font-size:13pt;font-weight:bold"><i class="fas fa-trash-alt icon-delete" ></i> Delete</span>');
         }
        }); 
        $('#delete').click(function() {
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('data-id'));
                console.log(idsArr);
            });  
            if(idsArr.length <=0)  
            {  
                alert("Please select atleast one record to delete.");  
            }  else {  
                if(confirm("Are you sure, you want to delete the selected Client IPs?")){  
                    $('#overlayDelete').fadeIn();
                    var strIds = idsArr.join(","); 
                    $.ajax({
                        url: 'deleteClient',
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ids": strIds,
                },
                dataType: 'JSON',
                        success: function (data) {
                            if(data=="success"){
                                $(".checkbox:checked").each(function() {  
                                    var tr=$(this).parents("tr").remove();
                                    table.row(tr).remove().draw();
                                });
                                $('#overlayDelete').fadeOut();
                            }
                        },
                    });
                }  
            }  
        });
        $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
} );
</script>
@endsection
