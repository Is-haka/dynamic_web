<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="signup-frm" method="post">
		<div class="form-group">
			<label for="" class="control-label">Firstname</label>
			<input type="text" name="first_name"  class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Lastname</label>
			<input type="text" name="last_name"  class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="text" name="email"  class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact</label>
			<input type="text" name="mobile"  class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password"  class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows="3" name="address"  class="form-control"></textarea>
		</div>
		<input type="submit" name="register" value="create" class="button btn btn-info btn-sm">
	</form>
</div>

<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>
<?php

	include("admin/db_connect.php");

	if (isset($_POST['register'])) {
		$fname = $_POST['first_name'];
		$lname = $_POST['last_name'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$hash = password_hash( $pass, PASSWORD_BCRYPT);
		$contact = $_POST['mobile'];
		$address = $_POST['address'];

		$userInfoQuery = "INSERT INTO user_info(first_name, last_name, email, password, mobile, address) VALUES('$fname', '$lname', '$email', '$hash', '$contact', '$address')";
		$userInfoResult = mysqli_query($conn, $userInfoQuery);
		if ($userInfoResult) {
			header("location: ./login.php");
			// echo "account is successfully created";
		}
		else {
			echo "error creating account";
		}
	}

?>
<script>
	$('#signup-frm').submit(function(e){
		e.preventDefault()
		$('#signup-frm button[type="submit"]').attr('disabled',true).html('Saving...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=signup',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#signup-frm input[type="submit"]').removeAttr('disabled').html('Create');

			}, 
			success:function(resp){
				if(resp ){
					location.href ='<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home'; ?>';
				}else{
					$('#signup-frm').prepend('<div class="alert alert-danger">Email already exist.</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
			}
		})
	})
</script>