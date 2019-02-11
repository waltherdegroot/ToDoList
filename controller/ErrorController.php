<?php

function error_404()
{
	if($_SESSION["Authorized"] == "true"){
		render("Error/404");
	}
	else{
		header("Location:".URL."Users/signin");
		exit;
	}
	
}