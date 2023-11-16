import {str_check, mail_check, tel_check, website_check, prodservice_check} from './config.js';

window.addEventListener("keypress", function(event){
    if (event.keyCode == 13){
        event.preventDefault();
    }
}, false);

var form = document.getElementById('provider-form');

form.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(form);

	arr_data.append('updateprovider', 'true');

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			Swal.fire({
				icon: 'success',
				title: '😃 Información enviada!! 🥳',
				text: 'Tu información ha sido guardada exitosamente, puedes ver tus datos en la sección de perfil de la empresa.',
				confirmButtonText: `De acuerdo! 👍`
			}).then(()=>{
				location.reload();
			});
		}else {
			Swal.fire({
				icon: 'error',
				title: '😦 Información no registrada!! 😞',
				text: 'Lamentamos este inconveniente, verifica tus datos e intenta nuevamente.',
				confirmButtonText: `Ok! 👍`
			});
		}

		$('#name').val('');
		$('#reason').val('');
		$('#dir').val('');
		$('#activity').val('');
		$('#tel').val('');
		$('#email').val('');
		$('#website').val('');
		$('#iva').val('');
		$('#nit').val('');
		$('#legal').val('');
		$('#prodservice').val('');
		$('#sellername').val('');
		$('#sellertel').val('');
		$('#sellercell').val('');
		$('#sellermail').val('');

		$('#name').removeClass('is-valid');
		$('#reason').removeClass('is-valid');
		$('#dir').removeClass('is-valid');
		$('#activity').removeClass('is-valid');
		$('#tel').removeClass('is-valid');
		$('#email').removeClass('is-valid');
		$('#website').removeClass('is-valid');
		$('#iva').removeClass('is-valid');
		$('#nit').removeClass('is-valid');
		$('#legal').removeClass('is-valid');
		$('#prodservice').removeClass('is-valid');
		$('#sellername').removeClass('is-valid');
		$('#sellertel').removeClass('is-valid');
		$('#sellercell').removeClass('is-valid');
		$('#sellermail').removeClass('is-valid');

		$('#name').removeClass('is-invalid');
		$('#reason').removeClass('is-invalid');
		$('#dir').removeClass('is-invalid');
		$('#activity').removeClass('is-invalid');
		$('#tel').removeClass('is-invalid');
		$('#email').removeClass('is-invalid');
		$('#website').removeClass('is-invalid');
		$('#iva').removeClass('is-invalid');
		$('#nit').removeClass('is-invalid');
		$('#legal').removeClass('is-invalid');
		$('#prodservice').removeClass('is-invalid');
		$('#sellername').removeClass('is-invalid');
		$('#sellertel').removeClass('is-invalid');
		$('#sellercell').removeClass('is-invalid');
		$('#sellermail').removeClass('is-invalid');
	});
});