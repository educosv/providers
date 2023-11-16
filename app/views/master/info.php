<?php require_once APP . "/views/master/header.php"; ?>

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= LANG['system_details'] ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= URL ?>?req=home"><?= LANG['home'] ?></a></li>
						<li class="breadcrumb-item active"><?= LANG['info_sys'] ?></li>
					</ol>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-12 col-md-12 col-lg-4 order-1 order-md-1">
								<h3 class="text-dark"><i class="fa-solid fa-car-rear"></i> <?= APP_NAME ?> <?= VERSION ?></h3>
								<br>
								<div class="text-muted">
									<p class="text-sm">Año de lanzamiento
									  <b class="d-block">2021</b>
									</p>
									<p class="text-sm">Lider del proyecto
									  <b class="d-block">Isaac Ramos</b>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<?php require_once APP."/views/master/footer_end.php"; ?>