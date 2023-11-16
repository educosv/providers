<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Solicitudes de soporte</title>
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
				<h1><?= LANG['support_report'] ?></h1>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
                            <th><?= LANG['user'] ?></th>
                            <th><?= LANG['email'] ?></th>
                            <th><?= LANG['subject'] ?></th>
                            <th><?= LANG['message'] ?></th>
                            <th><?= LANG['response'] ?></th>
                            <th><?= LANG['status'] ?></th>
						</tr>
					</thead>
					<?php $data = $model->support_list(); ?>
					<tbody>
						<?php if ($data): ?>
						<?php foreach ($data['idsupport'] as $i => $val): ?>
						<tr>
							<td><?= $i + 1 ?></td>
                            <td><?= $data['name'][$i] ?></td>
                            <td><?= $data['email'][$i] ?></td>
                            <td><?= $data['subject'][$i] ?></td>
                            <td><?= $data['mssg'][$i] ?></td>
                            <td><?= $data['response'][$i] ?></td>
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