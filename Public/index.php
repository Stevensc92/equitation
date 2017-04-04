<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(dirname(__FILE__)).'/back');
define('DS',   DIRECTORY_SEPARATOR);

define('INC', 		ROOT.DS.'inc');
define('CONFIG', 	ROOT.DS.'config');
define('TEMPLATES', ROOT.DS.'templates');
define('VIEW', 		ROOT.DS.'view');
define('MODEL', 	ROOT.DS.'models');
define('CONTROLLER',ROOT.DS.'controllers');

require_once CONFIG.DS.'database.php';
require_once INC.DS.'sql.php';
require_once MODEL.DS.'AppModel.php';

require_once 'autoload.php';
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1.0">
		<meta name="keywords" lang="fr" content="Equitation Evreux, Equitation Eure, Equitation Normandie, Centre Equestre Evreux, Centre Equestre Eure, Centre Equestre Normandie, Club Hippique Evreux, Club Hippique Eure, Club Hippique Normandie, Balade cheval Evreux, Balade cheval Eure, Balade cheval Normandie, Promenade cheval Evreux, Promenade cheval Eure, Promenade cheval Normandie, Pension cheval Evreux, Pension cheval Eure, Pension cheval Normandie, Pension cheval région parisienne, Débourrage cheval Evreux, Débourrage cheval Eure, Débourrage cheval Normandie, Stage CSO Evreux, Stage CSO Eure, Stage CSO Normandie, Stage CSO Ledermann, Equitation Ledermann, Alexandra Ledermann, Cheval Evreux, Cheval Eure, Cheval Normandie"/>
		<meta name="description" content="L’Ecole d’Equitation Ledermann près d’Evreux en Normandie vous propose promenades à cheval, leçons, pensions, CSO. Du niveau débutant au confirmé."/>
		<meta name="robots" content="index, follow" />
		<meta property="og:image" content="http://equitationledermann.com/img/alexandra_saut.png" />

		<link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" media="all" />
		<link rel="stylesheet" href="./css/style.css" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" type="text/css">

		<title>Ecole d'Equitation Ledermann - Evreux</title>
	</head>

	<body>

	<!-- == HEADER == -->
	<nav id="header" class="navbar navbar-default navbar-static-top">
		<div class="container-fluid" id="menu-test">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<img src="./img/logo.png" id="header-logo" alt="Logo de l'école"/>
				</a>
			</div>
			<!-- TODO : Modifier la police;
				 Fixer le button toggle;
				 "Couper" la nav et fixer à droite
			 -->
			<div class="collapse navbar-collapse" id="navbar-menu">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#famille" class="ancre">L'histoire</a></li>
					<li><a href="#philosophie" class="ancre">Philosophie</a></li>
					<li><a href="#installation" class="ancre">Installations</a></li>
					<li><a href="#service" class="ancre">Services</a></li>
					<li><a href="#tarif" class="ancre">Tarifs</a></li>
					<li><a href="#evreux" class="ancre">Localisation</a></li>
					<li>
						<a href="#evreux" class="ancre">
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<main id="container">
		<div id="home">
			<img src="./img/ecole.jpg" class="image-background" alt="Aperçu de l'école"/>
		</div>

		<div id="school" class="container">
			<div class="row">
				<div class="title-section">
					<h1 class="title"><?= School::getTitle() ?></h1>
					<div class="sub-title"><?= School::getSubTitle(); ?></div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-2 img-center">
					<img
						class="img-mobile"
						src="./img/balade.jpg"
						alt="Balade à cheval"
						title="Balade à cheval"
					/>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<p class="img-text">
						<?= School::getTxtBlock(1); ?>
					</p>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-2 col-md-push-4 img-center">
					<img
						class="img-mobile"
						src="./img/podium.png"
						alt="Podium"
						title="Podium"
					/>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-4 col-md-pull-2">
					<p class="img-text">
						<?= School::getTxtBlock(2); ?>
					</p>
				</div>
			</div>
		</div>

		<div id="portfolio">
			<img src="./img/alexandra_saut.png" class="image-background" alt="Alexandra saute avec son cheval" />
		</div>

		<div id="famille" class="container">
			<div class="row">
				<div class="title-section">
					<h3 class="title"><?= Famille::getTitle(); ?></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-5 col-xs-push-1 col-sm-4 col-sm-push-0 col-md-4 col-md-push-0 img-center">
					<img src="./img/grand_pere_cheval.jpg" class="img-mobile" alt="Grand père sur un cheval"/>
				</div>
				<div class="hidden-xs col-sm-4 col-md-4 img-center">
					<img src="./img/saut_obstacle.jpg" class="img-mobile" alt="Saut d'obstacle" />
				</div>
				<div class="col-xs-5 col-xs-push-1 col-sm-4 col-sm-push-0 col-md-4 col-md-push-0 img-center">
					<img src="./img/alexandra_celebration.jpg" class="img-mobile" alt="Alexandra Ledermann" />
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<p class="img-text">
						<?= Famille::getTxtBlock(1); ?>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 img-center visible-xs">
					<img src="./img/saut_obstacle.jpg" class="img-mobile paysage-solo-xxs" alt="Saut d'obstacle" />
				</div>
			</div>
		</div>

		<div id="philosophie" class="container">
			<div class="row">
				<div class="title-section">
					<h3 class="title"><?= Philosophie::getTitle(); ?></h3>
					<div class="sub-title"><?= Philosophie::getSubTitle(); ?></div>
				</div>
			</div>

			<div class="row col-md-4">
				<div class="col-xs-12 col-sm-12 img-center">
					<img
						class="img-mobile"
						src="./img/terrain_entrainement.png"
						alt="Terrain d'entraînement"
					/>
				</div>

				<div class="col-xs-12 col-sm-12">
					<p class="img-text" style="font-size:14px;">
						<?= Philosophie::getTxtBlock(1); ?>
					</p>
				</div>
			</div>

			<div class="row col-md-4">
				<div class="col-xs-12 col-sm-12 img-center">
					<img
						class="img-mobile"
						src="./img/alexandra_cheval.png"
						alt="Alexandra et son cheval"
					/>
				</div>

				<div class="col-xs-12 col-sm-12">
					<p class="img-text">
						<?= Philosophie::getTxtBlock(2); ?>
					</p>
				</div>
			</div>

			<div class="row col-md-4">
				<div class="col-xs-12 col-sm-12 img-center">
					<img
						class="img-mobile"
						src="./img/ecole_detente.png"
						alt="Ecole détente"
					/>
				</div>

				<div class="col-xs-12 col-sm-12">
					<p class="img-text">
						<?= Philosophie::getTxtBlock(3); ?>
					</p>
				</div>
			</div>
		</div>

		<div id="training_field">
			<img src="./img/terrain.png" class="image-background" alt="Terrain d'entraînement" />
		</div>

		<div id="installation" class="container">
			<div class="row">
				<div class="title-section">
					<h3 class="title"><?= Installation::getTitle(); ?></h3>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 img-center">
					<img
						class="img-mobile"
						src="./img/terrain_exterieur_1.png"
						alt="Terrain extérieur"
					/>

					<img
						class="img-mobile"
						src="./img/ecurie_exterieur.png"
						alt="Terrain écurie"
					/>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 img-center">
					<img
						class="img-mobile"
						src="./img/terrain_exterieur_2.png"
						alt="Terrain extérieur"
					/>

					<img
						class="img-mobile"
						src="./img/ecurie_interieur.png"
						alt="Ecurie interieur"
					/>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<p class="img-text">
						<?= Installation::getTxtBlock(1); ?>
					</p>
				</div>
			</div>
		</div>

		<div id="balade">
			<img src="./img/balade.png" class="image-background" alt="Balade en fôret" />
		</div>

		<div id="service" class="container">
			<div class="row">
				<div class="title-section">
					<h3 class="title"><?= Service::getTitle(); ?></h3>
				</div>
			</div>

			<div class="row row-container">
				<div class="row col-md-4 col-lg-4">
					<div class="col-xs-12 col-sm-12 img-center">
						<img
							class="img-mobile"
							src="./img/terrain_obstacle.png"
							alt="Terrain d'obstacle"
						/>
					</div>

					<div class="col-xs-12 col-sm-12">
						<p class="img-text">
							<?= Service::getTxtBlock(1); ?>
						</p>
					</div>
				</div>

				<div class="row col-md-4 col-lg-4">
					<div class="col-xs-12 col-sm-12 img-center">
						<img
							class="img-mobile"
							src="./img/terrain_obstacle_2.png"
							alt="Terrain d'obstacle"
						/>
					</div>

					<div class="col-xs-12 col-sm-12">
						<p class="img-text">
							<?= Service::getTxtBlock(2); ?>
						</p>
					</div>
				</div>

				<div class="row col-md-4 col-lg-4">
					<div class="col-xs-12 col-sm-12 img-center">
						<img
							class="img-mobile"
							src="./img/ecurie_cheval.png"
							alt="Cheval dans une écurie"
						/>
					</div>

					<div class="col-xs-12 col-sm-12">
						<p class="img-text">
							<?= Service::getTxtBlock(3); ?>
						</p>
					</div>
				</div>
			</div>
		</div>

		<div id="feets">
			<img src="./img/patte.jpg" alt="Pieds de chevaux" class="image-background" />
		</div>

		<div id="tarif" class="container">
			<div class="row">
				<div class="title-section">
					<h3 class="title"><?= Tarif::getTitle(); ?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-0 col-sm-2 col-md-1 col-lg-2"></div>
				<div class="col-xs-12 col-sm-10 col-md-4 col-lg-4">
					<?= Tarif::getTxtBlock(1); ?>
				</div>
				<div class="col-xs-0 col-sm-2 hidden-md"></div>
				<div class="col-xs-12 col-sm-10 col-md-6 col-lg-6">
					<img src="./img/cheval_bisou.png" alt="Bisous de cheval" class="img-responsive" />
				</div>
			</div>
		</div>

		<div id="evreux">
			<div class="row">
				<div class="title-section">
					<h2 class="title"><?= Evreux::getTitle(); ?></h2>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-5 img-center">
					<img src="./img/localisation.jpg" class="img-mobile" alt="Centre Evreux" />
					<div class="details">
						<img src="./img/feets.jpg" alt="Pieds" />
						<?= Evreux::getDistance(); ?>
					</div>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-6 img-center">
					<img src="./img/maps.jpg" class="img-mobile maps" alt="Localisation centre équitation Evreux" />
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 col-sm-2 col-md-6"></div>
				<div class="col-xs-12 col-sm-10 col-md-6">
					<div class="sub_maps">
						<span class="localisation">
							<img src="./img/icone_localisation.png" alt="Localisation" /> <span class="txt"><?= Evreux::getAddress(); ?></span>
						</span>
						<span class="clearfix mail">
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
							<span class="txt">&nbsp;<a href="mailto:ecurieledermann@alicepro.fr"><?= Evreux::getEmail(); ?></a></span>
						</span>
						<span class="clearfix number">
							<img src="./img/icone_tel.png" alt="Telephone" />
							<span class="txt">Tél : <a href="tel:0227341742"><?= Evreux::getTel(); ?></a></span>
						</span>
					</div>
				</div>
			</div>
		</div>
	</main>

	<footer id="footer">

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-91585223-1', 'auto');
		  ga('send', 'pageview');

		</script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<!-- <script type="text/javascript" src="http://parasponsive.com/para1/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.0"></script> -->

	</footer>
</body>
</html>
