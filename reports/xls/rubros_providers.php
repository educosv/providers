<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Informe</title>
		<?php include 'styles_css.php'; ?>
	</head>
	<body>
		<div class="row">
			<div class="col-12">
				<img src="<?= URL ?>dist/img/logo.png" width="120" height="83">
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<h1>Reporte de proveedores</h1>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr class="trhead">
							<td>No</td>
							<td>Proveedor</td>
							<td>Razón social</td>
							<td>Rubro</td>
							<td>Teléfono</td>
							<td>Email</td>
							<td>Homologación</td>
							<td>Estado</td>
						</tr>
					</thead>
					<?php
						$initdate = $_SESSION['data_report']['initdate'];
						$finishdate = $_SESSION['data_report']['finishdate'];
						$region = $_SESSION['data_report']['region'];
						$all = $_SESSION['data_report']['all'];
					?>
					<?php $data = $model->providers_list(); ?>
					<tbody>
						<?php if ($data): ?>
						<?php foreach ($data['idprovider'] as $i => $val): ?>
						<tr>
							<td><?= $i + 1 ?></td>
							<td><?= $data['name'][$i] ?></td>
							<td><?= $data['reason'][$i] ?></td>
							<td><?= $data['branch'][$i] ?></td>
							<td><?= $data['tel'][$i] ?></td>
							<td><?= $data['email'][$i] ?></td>
							<td><?php echo ($data['hstatus'][$i] == 4) ? 'pendiente' : 'finalizado'; ?></td>
							<td><?php echo ($data['approved'][$i] == 0) ? 'pendiente' : 'aprobado'; ?></td>
						</tr>
						<?php endforeach ?>
						<?php else: ?>
						<tr><td colspan="7"><p>Sin datos</p></td></tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
</html>