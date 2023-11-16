$(document).ready(() => {
	req = 'selecttab';

	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: req
	}).done(function(idtab){
		$('a[href="#'+idtab+'"]').tab('show');
	});

	$('#profile-info-tab').click(() => {
		data = 'usrprofileselecttab=info';
		$.ajax({
			type: 'post',
			url: 'internal_data',
			data: data
		});
	});

	$('#profile-access-tab').click(() => {
		data = 'usrprofileselecttab=access';
		$.ajax({
			type: 'post',
			url: 'internal_data',
			data: data
		});
	});
});

function picprofile(val) {
	let arr_data = new FormData();

	arr_data.append('id', val);
	arr_data.append('picprofile', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		var Toast = Swal.mixin({
			toast: false,
			position: 'center',
			showConfirmButton: true
		});

		$('#picProfile').modal('hide');

		if (data) {
			Toast.fire({
				icon: 'success',
				title: '😃 Success!! 🥳',
				text: 'Imagen de perfil actualizada con éxito!',
				confirmButtonText: `Genial 👍`
			}).then(()=>{
				location.reload();
			});
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Error! 😞',
				text: 'La imagen de perfil no pudo se actualizada.',
				confirmButtonText: 'Continuar 😞'
			});
		}
	});
}