function getprovider(id, action) {

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
			case 'edit':
				$('#edit-provider').modal('show');
				$('#ename').val(data.name);
				$('#econtact').val(data.contact);
				$('#etel').val(data.tel);
				$('#etype').val(data.idtype);
				$('#editprov').val(data.idprovider);
			break;

			case 'remove':
				$('#remove-provider').modal('show');
				$('#rname').html(data.name);
				$('#btnDelProv').val(data.idprovider);
			break;
		}
	});
}

var newProviderForm = document.getElementById('new-provider-form');

newProviderForm.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(newProviderForm);

	arr_data.append('newproviders', 'true');

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: true
	});

	if (arr_data.get('name') == '' || arr_data.get('type') == '' || arr_data.get('contact') == '' || arr_data.get('tel') == '')
	{
		Toast.fire({
			icon: 'error',
			title: '😦 Error! 😞',
			text: 'Ingresa datos válidos',
			confirmButtonText: 'De acuerdo 👍'
		});
	}
	else
	{
		fetch('internal_data', {
			method: 'POST',
			body: arr_data
		})
		.then(res => res.json())
		.then(data => {
			if (data) {
				Toast.fire({
					icon: 'success',
					title: '😃 Exito!! 🥳',
					text: 'Proveedor agregado con éxito!',
					confirmButtonText: 'Genial 👍'
				}).then(()=>{
					location.reload();
				});
			}else {
				Toast.fire({
					icon: 'error',
					title: '😦 Fail! 😞',
					text: 'Hubo un problema al agregar el proveedor, verifica los datos e intentalo nuevamente.',
					confirmButtonText: 'De acuerdo 👍'
				});
			}
		});
	}
});

var editProviderForm = document.getElementById('edit-provider-form');

editProviderForm.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(editProviderForm);

	arr_data.append('editprovider', 'true');

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: true
	});

	if (arr_data.get('ename') == '' || arr_data.get('etype') == '' || arr_data.get('econtact') == '' || arr_data.get('etel') == '')
	{
		Toast.fire({
			icon: 'error',
			title: '😦 Error! 😞',
			text: 'Ingresa datos válidos',
			confirmButtonText: 'De acuerdo 👍'
		});
	}
	else
	{
		fetch('internal_data', {
			method: 'POST',
			body: arr_data
		})
		.then(res => res.json())
		.then(data => {
			if (data) {
				Toast.fire({
					icon: 'success',
					title: '😃 Exito!! 🥳',
					text: 'Proveedor actualizado con éxito!',
					confirmButtonText: 'Genial 👍'
				}).then(()=>{
					location.reload();
				});
			}else {
				Toast.fire({
					icon: 'error',
					title: '😦 Fail! 😞',
					text: 'Hubo un problema al actualizar el proveedor, verifica los datos e intentalo nuevamente.',
					confirmButtonText: 'De acuerdo 👍'
				});
			}
		});
	}
});

$('#btnDelProv').click(() => {
	let arr_data = new FormData();

	arr_data.append('deleteprovider', $('#btnDelProv').val());

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: true
	});

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			Toast.fire({
				icon: 'success',
				title: '😃 proveedor eliminado! 🥳',
				confirmButtonText: `Genial! 👍`
			})
			.then(() => {
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Proveedor no eliminado 😞',
				text: 'Hemos tenido problemas para eliminar esta licencia, por favor contáctate con el administrador del sistema.',
				confirmButtonText: `De acuerdo! 👍`
			});
		}
	});
});