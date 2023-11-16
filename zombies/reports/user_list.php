<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Lista usuarios</title>
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
				<h1><?= LANG['user_report'] ?></h1>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th><?= LANG['full_name'] ?></th>
							<th><?= LANG['email'] ?></th>
							<th><?= LANG['position'] ?></th>
							<th><?= LANG['permission'] ?></th>
							<th><?= LANG['register_type'] ?></th>
							<th><?= LANG['status'] ?></th>
						</tr>
					</thead>
					<?php $data = $model->user_list(); ?>
					<tbody>
						<?php if ($data): ?>
						<?php foreach ($data['id'] as $i => $val): ?>
						<tr>
							<td><?= $i + 1 ?></td>
							<td><?= $data['name'][$i] ?></td>
							<td><?= $data['email'][$i] ?></td>
							<td><?= $data['position'][$i] ?></td>
							<td><?= $data['level'][$i] ?></td>
							<td><?= $data['registertype'][$i] ?></td>
							<td><?= $data['status'][$i] ?></td>
						</tr>
						<?php endforeach ?>
						<?php else: ?>
						<tr><td colspan="7"><p><?= LANG['empty_table'] ?></p></td></tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
</html>