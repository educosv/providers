
$(document).ready(() => {

    req = 'selecttab';

    $.ajax({
      type: 'post',
      url: 'internal_data',
      data: req
    }).done(function(idtab){
      $('a[href="#'+idtab+'"]').tab('show');
    });

    $('.profile-general-tab').click(() => {
      data = 'usrprofileselecttab=general';
      $.ajax({
        type: 'post',
        url: 'internal_data',
        data: data
      });
    });

    $('.profile-info-tab').click(() => {
      data = 'usrprofileselecttab=info';
      $.ajax({
        type: 'post',
        url: 'internal_data',
        data: data
      });
    });

    $('.profile-docs-tab').click(() => {
      data = 'usrprofileselecttab=docs';
      $.ajax({
        type: 'post',
        url: 'internal_data',
        data: data
      });
    });

    $('.profile-various-tab').click(() => {
      data = 'usrprofileselecttab=various';
      $.ajax({
        type: 'post',
        url: 'internal_data',
        data: data
      });
    });

    $('.profile-homologaciones-tab').click(() => {
      data = 'usrprofileselecttab=homologaciones';
      $.ajax({
        type: 'post',
        url: 'internal_data',
        data: data
      });
    });

    $('.profile-reports-tab').click(() => {
      data = 'usrprofileselecttab=reports';
      $.ajax({
        type: 'post',
        url: 'internal_data',
        data: data
      });
    });
});

// -------------------------------------------------------------------------------------------------------------------------------------------------

$('#add_h').click(()=>{

	Swal.fire({
		icon: 'info',
		title: `Nueva homologación`,
		html: `
		<div class="text-center">
		  <p>¿Estás seguro de iniciar el proceso de homologación con este proveedor?</p>
		  <p>Al dar click en <i>aceptar,</i> se le enviará un correo electrónico con la información necesaria para dicho proceso.</p>
		</div>
		`,
		showDenyButton: false,
		showCancelButton: true,
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar',
		allowOutsideClick: false
	}).then(async (result) => {
		if (result.isConfirmed)
		{
			var arr_data = new FormData();

			arr_data.append('add_h', $('#add_h').val());

			Swal.fire({
		        title: '📨 Iniciando procedimiento 📬',
		        html: 'Estamos enviando las instrucciones al proveedor vía correo electrónico, por favor no cierres la ventana del navegador.',
		        didOpen: () => {
		            Swal.showLoading();
		        }
		    });

		    const response = await fetch('internal_data', {
		        method: 'POST',
		        body: arr_data
		    })
		    .then(res => res.json())
		    .then(data => {
		        return data;
		    });

			if (response) {
				Swal.fire({
					title: '¡Genial!',
					text: 'Porceso de homologación iniciado',
					icon: 'success',
					confirmButtonText: 'Aceptar'
				}).then(()=>{ location.reload(); });
			}else {
				Swal.fire({
					title: '¡Ups!',
					text: 'Hubo un error al iniciar el proceso con el proveedor, es probable que el proveedor tenga un proceso iniciado.',
					icon: 'error',
					confirmButtonText: 'Aceptar'
				}).then(()=>{ location.reload(); });
			}
		}
	});
});