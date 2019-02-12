<?php
	if($_SESSION["Authorized"] == "true"){
        header("Location:../My");
    }
?>
<div class="card login-card">
	<div class="card-header card-header-color card-header-dark">
		<div>
			<h3>Sign-up</h3>
		</div>	
	</div>
	<div class="card-body">	
		<form action="<?= URL ?>Users/signup" method="post" class="">
			<div class="form-group">
				<input type="text" class="form-control" name="username" placeholder="username ... " autocomplete="off" required>
                <input type="email" class="form-control" name="email" placeholder="email ... " autocomplete="off" required>
                <input type="password" class="form-control" name="password" placeholder="password ..." autocomplete="off" required>
                <input type="password" class="form-control" name="repeatPassword" placeholder="Repeat password ..." autocomplete="off" required>
			</div>
			<input type="submit" class="btn btn-info">
		</form>
	</div>
</div>