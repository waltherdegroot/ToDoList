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
	<script src="<?= URL ?>js/jquery-3.3.1.min.js"></script>

	<title>To Do List</title>	
</head>
<body class="bg-info">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="<?= URL ?>home/index">Home</a></li>
			<?php if($_SESSION["Authorized"] == "true"):?>
				<li class="nav-item-dark"><a class="nav-link" href="<?= URL ?>My/CreateList">Create List</a></li>
				<li class="nav-item-dark"><a class="nav-link" href="<?= URL ?>My/index">My Lists</a></li>

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
				<?= $_SESSION["Username"] ?>
				
				<a class="logout" href="<?= URL ?>Users/logout">logout</a>
			</div>
		<?php else: ?>
			<div>
				<a href="<?= URL ?>Users/signin">sign-in</a>
				<a href="<?= URL ?>Users/signup">sign-up</a>
			</div>
		<?php endif; ?>
	</nav>
	<div class="main-content container text-center">
	
