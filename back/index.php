<?php
session_start();

// error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT', dirname(__FILE__));
define('DS',   DIRECTORY_SEPARATOR);

define('INC', ROOT.DS.'inc');
define('CONFIG', ROOT.DS.'config');

require_once 'Autoload.php';

include ('templates/header.php');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Dashboard <small>Statistics Overview</small>
				</h1>
				<ol class="breadcrumb">
					<li class="active">
						<i class="fa fa-dashboard"></i> Dashboard
					</li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php
include('templates/footer.php');
?>
