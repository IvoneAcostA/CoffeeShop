<?php
session_start();
$_SESSION['mi_variable'] = 'Valor de mi variable de sesión';
?>
<html>
	<head>
		<title>CRUD</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body>
	<?php 
	include "php/navbar.php";
	?>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
			<h2>CRUD</h2>
			<p class="lead">Usuarios</p>
			

	</div>
	</div>
	</div>
	</body>
</html>
