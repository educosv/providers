
function aprobar (id) {
	Swal.fire({
		icon: 'question',
		title: `Aprobar proveedor`,
		html: `
		<div class="text-center">
		  ¿Estás completamente segura/o de aprobar este proveedor?<br>
		</div>
		`,
		showDenyButton: false,
		showCancelButton: true,
		confirmButtonText: 'Aprobar',
		cancelButtonText: 'Cancelar',
		allowOutsideClick: false
    }).then((result) => {
		if (result.isConfirmed)
		{
			var arr_data = new FormData();

			arr_data.append('aprobar', true);

			fetch('internal_data', {
			  method: 'POST',
			  body: arr_data
			})
			.then(res => res.json())
			.then(data => {
			  if (data)
			  {
			    Swal.fire({
			    	icon: 'success',
			    	title: 'Proveedor aprobado',
			    	html: '',
			    	confirmButtonText: 'Aceptar'
			    }).then(()=>{
			    	location.reload();
			    });
			  }
			  else
			  {
			    Swal.fire('Error', '', 'error');
			  }
			});
		}
    });
}

function desaprobar (id) {
	Swal.fire({
		icon: 'question',
		title: `Desaprobar proveedor`,
		html: `
		<div class="text-center">
		  ¿Estás completamente segura/o de desaprobar este proveedor?<br>
		</div>
		`,
		showDenyButton: false,
		showCancelButton: true,
		confirmButtonText: 'Desaprobar',
		cancelButtonText: 'Cancelar',
		allowOutsideClick: false
    }).then((result) => {
		if (result.isConfirmed)
		{
			var arr_data = new FormData();

			arr_data.append('desaprobar', true);

			fetch('internal_data', {
			  method: 'POST',
			  body: arr_data
			})
			.then(res => res.json())
			.then(data => {
			  if (data)
			  {
			    Swal.fire({
			    	icon: 'success',
			    	title: 'Proveedor desaprobado',
			    	html: '',
			    	confirmButtonText: 'Aceptar'
			    }).then(()=>{
			    	location.reload();
			    });
			  }
			  else
			  {
			    Swal.fire('Error', '', 'error');
			  }
			});
		}
    });
}