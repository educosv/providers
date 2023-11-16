var passform = document.getElementById('password-form');

passform.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(passform);

	arr_data.append('updtpwd', 'true');

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: true
	});

	if (arr_data.get('pass1') == '' || arr_data.get('pass2') == '')
	{
		Toast.fire({
			icon: 'error',
			title: '😦 Error! 😞',
			text: 'Ingrese datos válidos',
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
					title: '😃 Felicidades!! 🥳',
					text: 'La contraseña ha sido actualizada!',
					confirmButtonText: `Genial! 👍`
				});
			}else {
				Toast.fire({
					icon: 'error',
					title: '😦 Error! 😞',
					text: 'La contraseña no pudo ser actualizada.',
					confirmButtonText: `Continuar`
				});
			}

			if ($('#currentPass').length) { $('#currentPass').val(''); }
			$('#pass1').val('');
			$('#pass1').removeClass("is-valid");
			$('#mnsj').html('');
			$('#pass2').val('');
			$('#pass2').removeClass("is-valid");
			$('#mnsj2').html('');
			$("#modal_pwd").modal('hide');
		});
	}
});