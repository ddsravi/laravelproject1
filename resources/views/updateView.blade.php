<html>
<head>
<title>Update</title>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>
</head>
<body>
	<div class="container">
		<form action="{{ route('user.update')}}" method="post" align="center">
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
				<div class="form-group">
					<label for="txtid">ID</label>
					<input type="text" name="txtid" value="{{$user->id}}" readonly>
				</div>
				<div class="form-group">
					<label for="txtname">name</label>
					<input type="text" name="txtname" value="{{$user->name}}" >
				</div>
				<div class="form-group">
					<label for="txtemail">email</label>
					<input type="text" name="txtemail" value="{{$user->email}}" readonly>
				</div>
				<div class="form-group">
					<label for="">Role</label>
					<select name="txtrole">
						<option value="0"  @if($user->role==0) selected @endif  >User</option>
						<option value="1"  @if($user->role==1) selected @endif  >Admin</option>
						<option value="2"  @if($user->role==2) selected @endif  >superAdmin</option>
					</select>
				</div>
				<button type="submit"  class="btn btn-primary">Submit</button>
		</form>
	</div>
</body>
</html>