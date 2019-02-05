<?php
	if($_SESSION["Authorized"] == "true"){
        header("Location:../My/index");
    }
?>
<div class="card login-card">
	<div class="card-header card-header-color card-header-dark">
		<div>
			<h3>Sign-in</h3>
		</div>	
	</div>
	<div class="card-body">	
		<form action="<?= URL ?>Users/signin" method="post" class="">
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="email ... " autocomplete="off">
				<input type="password" class="form-control" name="password" placeholder="password ..." autocomplete="off">
			</div>
			<input type="submit" class="btn btn-info" value="Submit">
		</form>
	</div>
</div>