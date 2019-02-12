<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?= URL ?>css/style.css">
	<link rel="stylesheet" href="<?= URL ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?= URL ?>css/bootstrap.css.map">
	<link rel="stylesheet" href="<?= URL ?>css/animate.css">
	<script src="<?= URL ?>js/jquery-3.3.1.min.js"></script>
	<script src="<?= URL ?>js/main.js"></script>
	<script src="<?= URL ?>js/bootstrap-notify.js"></script>

	<title>To Do List</title>	
</head>

<?php
	if($_SESSION["Authorized"] == "true" && $_SESSION["UserColor"] != null){
		echo "<body class='bg-".$_SESSION["UserColor"]."'>";
	}
	else{
		echo "<body class='bg-info'>";
	}
?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="<?= URL ?>home/index">Home</a></li>
			<?php if($_SESSION["Authorized"] == "true"):?>
				<li class="nav-item-dark"><a class="nav-link" href="<?= URL ?>My/CreateList">Create List</a></li>
				<li class="nav-item-dark"><a class="nav-link" href="<?= URL ?>My/">My Lists</a></li>

				<?php if($_SESSION["Role"] == "Admin"):?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown">
							Admin
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= URL ?>Admin/Users">User Management</a>
							<a class="dropdown-item" href="<?= URL ?>Admin/Lists">List Management</a>
						</div>
					</li>
				<?php endif ?>

			<?php endif; ?>
			
		</ul>
		<?php if($_SESSION["Authorized"] == "true"):?>
			<div>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"><?= $_SESSION["Username"] ?></a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="<?= URL ?>My/Settings">Settings</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= URL ?>Users/logout">Logout</a>
						</div>
					</li>
				</ul>
			</div>

		<?php else: ?>

			<div>
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown">Login/Sign-Up</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="<?= URL ?>Users/signin">Login</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= URL ?>Users/signup">Signup</a>
						</div>
					</li>
				</ul>
			</div>
		<?php endif; ?>
	</nav>
	<div class="main-content container text-center">
	
