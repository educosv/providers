function getlicense(id, action) {

	let arr_data = new FormData();

	arr_data.append('id', id);
	arr_data.append('getinfolicense', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		switch (action) {
			case 'edit':
				$('#edit-license').modal('show');
				$('#endoc').val(data.ndoc);
				$('#eduedate').val(data.duedate);
				$('#etype').val(data.type);
				$('#editlic').val(data.idlic);
			break;

			case 'remove':
				$('#remove-license').modal('show');
				$('#btnDelLic').val(data.idlic);
			break;

			case 'approve':
				$('#approve-license').modal('show');
				$('#btnApproveLic').val(data.idlic);
			break;

			case 'deny':
				$('#deny-license').modal('show');
				$('#btnDenyLic').val(data.idlic);
			break;
		}
	});
}

var newLicenseForm = document.getElementById('newLicenseForm');

newLicenseForm.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(newLicenseForm);

	arr_data.append('newlicense', 'true');

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
		if (data == 1) {
			Toast.fire({
				icon: 'success',
				title: '😃 Licencia registrada!! 🥳',
				confirmButtonText: `Genial! 👍`
			})
			.then(() => {
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Licencia no registrada 😔',
				text: 'Es posible que el tipo de licencia ya esté registrado. Verifica los datos y vuelve a intentarlo',
				confirmButtonText: `De acuerdo! 👍`
			});

			$('#new_license_modal').modal('hide');
			$('#ndoc').val('');
			$('#duedate').val('');
		}
	});
});


var editLicenseForm = document.getElementById('editLicenseForm');

editLicenseForm.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(editLicenseForm);

	arr_data.append('editlicense', 'true');

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
		if (data == 1) {
			Toast.fire({
				icon: 'success',
				title: '😃 Licencia actualizada!! 🥳',
				confirmButtonText: `Genial! 👍`
			})
			.then(() => {
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Licencia no actualizada 😞',
				text: 'Es posible que el tipo de licencia ya esté registrado. Verifica los datos y vuelve a intentarlo',
				confirmButtonText: `De acuerdo! 👍`
			});

			$('#edit-license').modal('hide');
			$('#endoc').val('');
			$('#eduedate').val('');
		}
	});
});


$('#btnDelLic').click(() => {
	let arr_data = new FormData();

	arr_data.append('deletelicense', $('#btnDelLic').val());

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
				title: '😃 Licencia eliminada! 🥳',
				confirmButtonText: `Genial! 👍`
			})
			.then(() => {
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Licencia no eliminada 😞',
				text: 'Hemos tenido problemas para eliminar esta licencia, por favor contactate con el administrador del sistema.',
				confirmButtonText: `De acuerdo! 👍`
			});
		}
	});
});


$('#btnApproveLic').click(() => {
	let arr_data = new FormData();

	arr_data.append('approvelicense', $('#btnApproveLic').val());

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
				title: '😃 Licencia Autorizada! 🥳',
				confirmButtonText: `Genial! 👍`
			})
			.then(() => {
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Licencia no autorizada 😞',
				text: 'Hemos tenido problemas para autorizar esta licencia, por favor contáctate con el administrador del sistema.',
				confirmButtonText: `De acuerdo! 👍`
			});
		}
	});
});


$('#btnDenyLic').click(() => {
	let arr_data = new FormData();

	arr_data.append('denylicense', $('#btnDenyLic').val());

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
				title: '😃 Licencia Desautorizada! 🥳',
				confirmButtonText: `Genial! 👍`
			})
			.then(() => {
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Licencia no desautorizada 😞',
				text: 'Hemos tenido problemas para desautorizar esta licencia, por favor contáctate con el administrador del sistema.',
				confirmButtonText: `De acuerdo! 👍`
			});
		}
	});
});