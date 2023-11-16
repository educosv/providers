function getinfo(id, action) {
	console.log("id", id);

	let arr_data = new FormData();

	arr_data.append('id', id);
	arr_data.append('getinfoprovider', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		switch (action) {
			case 'info':
				$('#info-provider').modal('show');
				$('#info_name').val(data.name);
				$('#info_reason').val(data.reason);
				$('#info_type').val(data.type);
				$('#info_branch').val(data.branch);
				$('#info_activity').val(data.activity);
				$('#info_address').val(data.address);
				$('#info_tel').val(data.tel);
				$('#info_email').val(data.email);
				$('#info_website').val(data.website);
			break;

			case 'del':
				const bstrpBtn = Swal.mixin({
					confirmButtonClass: 'btn btn-educodanger mr-2',
					cancelButtonClass: 'btn btn-secondary',
					buttonsStyling: false
				});

				bstrpBtn.fire({
					icon: 'info',
					title: `⚠️ Eliminar proveedor 🗑️`,
					html: `
					<div class="text-center">
					  <p>¿Estás seguro de eliminar el proveedor: <strong>"${data.name}"</strong>?</p>
					  <p>Al dar click en <i>borrar,</i> perderás toda la información y documentos de este proveedor.</p>
					</div>
					`,
					showDenyButton: false,
					showCancelButton: true,
					confirmButtonText: 'Borrar',
					cancelButtonText: 'Cancelar',
					allowOutsideClick: false
				}).then((result) => {
					if (result.isConfirmed)
					{
						var arr_data = new FormData();

						arr_data.append('deleteprovider', id);

						fetch('internal_data', {
							method: 'POST',
							body: arr_data
						})
						.then(res => res.json())
						.then(data => {
							if (data)
								Swal.fire('Proveedor eliminado', '', 'success').then(()=>{ location.reload(); });
							else
								Swal.fire('Hubo un error al eliminar el proveedor, por favor intente más tarde.', '', 'error').then(()=>{ location.reload(); });
						});
					}
				});
			break;
		}
	});
}