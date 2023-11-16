<?php require_once APP."/views/master/header.php"; ?>

<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<?php require_once APP."/views/master/{$_SESSION['session_providers']['level']}_nav.php"; ?>

<?php $regions = $model->region_list($_SESSION['session_providers']['idcountry']); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="nav-icon fas fa-file-invoice fa-xs"></i> Reportes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= URL ?>?request=home">Inicio</a></li>
              <li class="breadcrumb-item active">Reportes</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h3>Selecciona el reporte que deseas imprimir</h3>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12 col-md-4">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa-solid fa-calculator"></i> Lista de proveedores
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <form action="print_report" method="post">
                  <div class="form-row mt-3">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="hidden" name="report" value="rubros_providers">
                        <button type="submit" class="btn btn-sm btn-success" id="xls1" name="print" value="xls">Imprimir XLS</button>
                        <button type="submit" class="btn btn-sm btn-danger" id="pdf1" name="print" value="pdf">Imprimir PDF</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>


<?php require_once APP."/views/master/footer_js.php"; ?>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/datatable.js"></script>

<?php require_once APP."/views/master/footer_end.php"; ?>