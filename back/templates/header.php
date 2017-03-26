<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administration</title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="css/sb-admin.css" rel="stylesheet">
	<!-- Morris Charts CSS -->
	<link href="css/plugins/morris.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php if (User::isLogged()) : ?>
	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./">
					<img src="../Public/img/logo.png" id="logo" alt="Logo de l'école"/>
				</a>
			</div>
			<!-- Top Menu Items -->
			<ul class="nav navbar-right top-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user"></i>
						<?= $_SESSION['admin']['username']; ?>
						<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="divider"></li>
						<li>
							<a href="?action=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav side-nav">
                    <li>
                        <a data-toggle="collapse" data-target="#content">
                            <i class="fa fa-fw fa-cog"></i> Modifier contenu <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="content" class="collapse">
                            <li>
                                <a href="?update=school">L'école d'équitation</a>
                            </li>
                            <li>
                                <a href="?update=famille">Histoire</a>
                            </li>
                            <li>
                                <a href="?update=philosophie">Philosophie</a>
                            </li>
                            <li>
                                <a href="?update=installation">Installation</a>
                            </li>
                            <li>
                                <a href="?update=service">Service</a>
                            </li>
                            <li>
                                <a href="?update=tarif">Les tarifs</a>
                            </li>
                            <li>
                                <a href="?update=evreux">Localisation/Détails</a>
                            </li>
                        </ul>
                    </li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>
	<?php endif; // end User::isLogged ?>
