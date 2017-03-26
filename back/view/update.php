<?php
$page = $model;
$page->contenu = $page->getContent();
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Modification de la section
					<span class="txt_special"><?= $page->getTitle(); ?></span>
				</h1>

				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard fa-fw"></i> <a href="./">Dashboard</a></li>
					<li><i class="fa fa-cog fa-fw"></i> <a href="./">Modification</a></li>
					<li class="active">
						<?= ucfirst($_GET['update']); ?>
					</li>
				</ol>
			</div>
		</div>
		<?php if(isset($message)) : ?>
		<div class="alert alert-<?= $message->type; ?>">
			<p><?= $message->content; ?></p>
		</div>
		<?php endif; ?>
        <form method="post" action="" class="updateForm">
            <?php foreach ($page->contenu as $k => $v) : ?>
				<?php if ($k === 'title') : ?>
				<div class="form-group">
					<label for="<?= $k ?>"><?= $controller->nameField[$k]; ?></label>
					<input name="<?= $k ?>" class="form-control" value="<?= $v ?>" />
				</div>
				<?php else: ?>
				<div class="form-group textarea-group">
					<label for="<?= $k ?>"><?= $controller->nameField[$k]; ?></label>
					<textarea name="<?= $k ?>" class="form-control"><?= $v ?></textarea>
				</div>
				<?php endif; ?>
            <?php endforeach; ?>
			<div class="form-group">
				<button type="submit" class="btn btn-default" name="updateForm">Modifier</button>
			</div>
        </form>
	</div>
</div>
