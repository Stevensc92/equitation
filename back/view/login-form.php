<div id="page-wrapper">
	<div class="container-fluid">
		<div class="main-login main-center">
				<form method="post" action="" class="login-form">
					<div class="form-group">
						<label for="mail">Adresse e-mail</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
							<input
								type="text"
								name="mail"
								class="form-control"
								id="mail"
								placeholder="Votre adresse email"
							/>
						</div>
					</div>
					<div class="form-group">
						<label for="password">Mot de passe</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<input
								type="password"
								name="password"
								class="form-control"
								id="password"
								placeholder="Votre mot de passe"
							/>
						</div>
					</div>
					<?php if(isset($error)) : ?>
						<div class="form-group alert alert-danger">
							<?= $error; ?>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<button type="submit" name="loginForm" class="btn btn-default btn-lg btn-block">Se connecter !</button>
					</div>
				</form>
		</div>
	</div>
</div>
