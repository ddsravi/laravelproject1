@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<table class="table table-bordered data-table" id="dstable">
						<thead>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</thead>
					</table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Edit User</h4>
            </div>
            <div class="modal-body">
                <form id="userForm" name="userForm" class="form-horizontal">
				<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                   <input type="text" name="txtid" id="txtid" class="form-control col-md-4"  hidden readonly>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="txtname" id="txtname" class="form-control "  >
                        </div>
                    </div>
     
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" name="txtemail" id="txtemail" class="form-control "  readonly>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-12">
                          <select name="txtrole" id="txtrole" class="form-control">
							<option value="0">User</option>
							<option value="1" >Admin</option>
							<option value="2">superAdmin</option>
						</select>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" >Update
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
	//alert('hi');
	var table = $('#dstable').DataTable({
	processing:true,
	serverSide:true,
	ajax:'{{ route('home')}}',
	columns:[
			{data:'id',name:'id'},
			{data:'name',name:'name'},
			{data:'email',name:'email'},
			{data:'role',name:'role'},
			{data:'action',name:'Action',orderable:false,searchable:false},
	
	]
});
	$('body').on('click','.deleteUser',function(){
		
		var id = $(this).data('id');
		//alert(id);
		confirm("Are you sure you want to delete ?");
		
		$.ajax({
			
			url:"delete/"+id,
			type:"GET",
			success:function(data){
				console.log(data);
				table.draw();
			}
			
			
		});
	});
	
	$('body').on('click','.editUser',function(){
		
		var id = $(this).data('id');
		//alert(id);
		$.get("update/"+id,function(data){
			console.log(data[0]);
			$('#ajaxModel').modal('show');
			$('#txtid').val(data[0].id);
			$('#txtname').val(data[0].name);
			$('#txtemail').val(data[0].email);
			$("#txtrole option[value='"+data[0].role+"']").attr("selected",true);
			
			
		});
		
	});
	
	$('body').on('submit','#userForm',function(e){
		e.preventDefault();
		
		$.ajax({
			
			url:"update",
			type:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success:function(data){
				console.log(data);
				$('#ajaxModel').modal('toggle');
				table.draw();
			}
		})
		
		
		
	});
});
</script>
@endsection

