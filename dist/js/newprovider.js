import {number_check, str_check, mail_check, tel_check, website_check, prodservice_check} from './config.js';

window.addEventListener("keypress", function(event){
    if (event.keyCode == 13){
        event.preventDefault();
    }
}, false);

var form = document.getElementById('provider-form');

var	campos = {
	name: false,
	reason: false,
	dir: false,
	activity: false,
	tel: false,
	email: false,
	nit: false,
	legal: false,
	prodservice: false,
	sellername: false,
	sellercell: false,
	sellermail: false
}

var	loscampos = {
	name: 'name',
	reason: 'reason',
	dir: 'dir',
	activity: 'activity',
	tel: 'tel',
	email: 'email',
	nit: 'nit',
	legal: 'legal',
	prodservice: 'prodservice',
	sellername: 'sellername',
	sellercell: 'sellercell',
	sellermail: 'sellermail'
}

const validateform = () => {
	let res = true;
	for (var val in campos) {
	    if (!campos[val]) {
	    	res = false;
	    	break;
	    }
	}
}

const checkform = () => {
	let name = '';
	for (var val in loscampos) {
		if (!campos[val]) {
	    	name = '#'+loscampos[val];
	    	$(name).addClass('is-invalid');
	    }
	}
}

$("#name").keyup(() => {

	let name = document.getElementById('name').value;

	if (str_check(name.trim()))
	{
		$("#name").removeClass('is-invalid');
		$("#name").addClass('is-valid');
		campos.name = true;
	}
	else
	{
		$("#name").removeClass('is-valid');
		$("#name").addClass('is-invalid');
		campos.name = false;
	}

	validateform();
});

$("#reason").keyup(() => {

	let reason = document.getElementById('reason').value;

	if (str_check(reason.trim()))
	{
		$("#reason").removeClass('is-invalid');
		$("#reason").addClass('is-valid');
		campos.reason = true;
	}
	else
	{
		$("#reason").removeClass('is-valid');
		$("#reason").addClass('is-invalid');
		campos.reason = false;
	}

	validateform();
});

$("#dir").keyup(() => {

	let dir = document.getElementById('dir').value;

	if (str_check(dir.trim()))
	{
		$("#dir").removeClass('is-invalid');
		$("#dir").addClass('is-valid');
		campos.dir = true;
	}
	else
	{
		$("#dir").removeClass('is-valid');
		$("#dir").addClass('is-invalid');
		campos.dir = false;
	}

	validateform();
});

$("#activity").keyup(() => {

	let activity = document.getElementById('activity').value;

	if (str_check(activity.trim()))
	{
		$("#activity").removeClass('is-invalid');
		$("#activity").addClass('is-valid');
		campos.activity = true;
	}
	else
	{
		$("#activity").removeClass('is-valid');
		$("#activity").addClass('is-invalid');
		campos.activity = false;
	}

	validateform();
});

$("#tel").keyup(() => {

	let tel = document.getElementById('tel').value;

	if (tel_check(tel.trim()))
	{
		$("#tel").removeClass('is-invalid');
		$("#tel").addClass('is-valid');
		campos.tel = true;
	}
	else
	{
		$("#tel").removeClass('is-valid');
		$("#tel").addClass('is-invalid');
		campos.tel = false;
	}

	validateform();
});

$("#email").keyup(() => {

	let email = document.getElementById('email').value;

	if (mail_check(email.trim()))
	{
		$("#email").removeClass('is-invalid');
		$("#email").addClass('is-valid');
		campos.email = true;
	}
	else
	{
		$("#email").removeClass('is-valid');
		$("#email").addClass('is-invalid');
		campos.email = false;
	}

	validateform();
});


$("#nit").keyup(() => {

	let nit = document.getElementById('nit').value;

	if (number_check(nit.trim()))
	{
		$("#nit").removeClass('is-invalid');
		$("#nit").addClass('is-valid');
		campos.nit = true;
	}
	else
	{
		$("#nit").removeClass('is-valid');
		$("#nit").addClass('is-invalid');
		campos.nit = false;
	}

	validateform();
});

$("#legal").keyup(() => {

	let legal = document.getElementById('legal').value;

	if (str_check(legal.trim()))
	{
		$("#legal").removeClass('is-invalid');
		$("#legal").addClass('is-valid');
		campos.legal = true;
	}
	else
	{
		$("#legal").removeClass('is-valid');
		$("#legal").addClass('is-invalid');
		campos.legal = false;
	}

	validateform();
});

$("#prodservice").keyup(() => {

	let prodservice = document.getElementById('prodservice').value;

	if (prodservice_check(prodservice.trim()))
	{
		$("#prodservice").removeClass('is-invalid');
		$("#prodservice").addClass('is-valid');
		campos.prodservice = true;
	}
	else
	{
		$("#prodservice").removeClass('is-valid');
		$("#prodservice").addClass('is-invalid');
		campos.prodservice = false;
	}

	validateform();
});

$("#sellername").keyup(() => {

	let sellername = document.getElementById('sellername').value;

	if (str_check(sellername.trim()))
	{
		$("#sellername").removeClass('is-invalid');
		$("#sellername").addClass('is-valid');
		campos.sellername = true;
	}
	else
	{
		$("#sellername").removeClass('is-valid');
		$("#sellername").addClass('is-invalid');
		campos.sellername = false;
	}

	validateform();
});

$("#sellercell").keyup(() => {

	let sellercell = document.getElementById('sellercell').value;

	if (tel_check(sellercell.trim()))
	{
		$("#sellercell").removeClass('is-invalid');
		$("#sellercell").addClass('is-valid');
		campos.sellercell = true;
	}
	else
	{
		$("#sellercell").removeClass('is-valid');
		$("#sellercell").addClass('is-invalid');
		campos.sellercell = false;
	}

	validateform();
});

$("#sellermail").keyup(() => {

	let sellermail = document.getElementById('sellermail').value;

	if (mail_check(sellermail.trim()))
	{
		$("#sellermail").removeClass('is-invalid');
		$("#sellermail").addClass('is-valid');
		campos.sellermail = true;
	}
	else
	{
		$("#sellermail").removeClass('is-valid');
		$("#sellermail").addClass('is-invalid');
		campos.sellermail = false;
	}

	validateform();

	checkform();
});

$('#btn_reset').click(() => {
	$('#name').removeClass('is-valid');
	$('#reason').removeClass('is-valid');
	$('#dir').removeClass('is-valid');
	$('#activity').removeClass('is-valid');
	$('#tel').removeClass('is-valid');
	$('#email').removeClass('is-valid');
	$('#nit').removeClass('is-valid');
	$('#legal').removeClass('is-valid');
	$('#prodservice').removeClass('is-valid');
	$('#sellername').removeClass('is-valid');
	$('#sellercell').removeClass('is-valid');
	$('#sellermail').removeClass('is-valid');

	$('#name').removeClass('is-invalid');
	$('#reason').removeClass('is-invalid');
	$('#dir').removeClass('is-invalid');
	$('#activity').removeClass('is-invalid');
	$('#tel').removeClass('is-invalid');
	$('#email').removeClass('is-invalid');
	$('#nit').removeClass('is-invalid');
	$('#legal').removeClass('is-invalid');
	$('#prodservice').removeClass('is-invalid');
	$('#sellername').removeClass('is-invalid');
	$('#sellercell').removeClass('is-invalid');
	$('#sellermail').removeClass('is-invalid');
});

form.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(form);

	arr_data.append('verifica_provider', 'true');

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data)
		{
			Swal.fire({
				icon: 'warning',
				title: 'Proveedor registrado',
				html: `
				<p>Te informamos que el proveedor que deseas ingresar posiblemente ya se encuentra registrado en nuestra base de datos</p>
				<p>¿Deseas iniciar el proceso de revisión o prefieres revisar la información e intentar nuevamente?</p>
				`,
				showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'iniciar proceso',
                cancelButtonText: 'intentar nuevamente'
			}).then((result) => {
				if (result.isConfirmed) {
					let revision = new FormData(form);

					revision.append('inicia_revision', 'true');

					fetch('internal_data', {
						method: 'POST',
						body: revision
					})
					.then(res => res.json())
					.then(data => {
						if (data) {
							Swal.fire({
								icon: 'success',
								title: 'Proceso de revisión iniciado',
								html: `
									<p>La notificación de registro ha sido enviada y será revisada por nuestro personal de Educo</p>
									<p>Mantente al pendiente de tu cuenta de correo registrada.</p>
									<p><strong>El formulario de registro estará disponible al finalizar el proceso de revisión.</strong></p>
								`,
								confirmButtonText: `Aceptar`
							}).then(()=>{
								location.reload();
							});
						}else {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								html: `
									<p>Hubo un problema al iniciar el proceso de revisión iniciado</p>
									<p>Intenta nuevamente o contactate con tu contacto Educo.</p>
								`,
								confirmButtonText: `Aceptar`
							}).then(()=>{
								location.reload();
							});
						}
					});
				}else{
					Swal.fire('Verifica tus datos e intenta nuevamente', '', 'info');
				}
			});
		}
		else
		{
			let rerquest = new FormData(form);

			rerquest.append('addprovider', 'true');

			fetch('internal_data', {
				method: 'POST',
				body: rerquest
			})
			.then(res => res.json())
			.then(info => {
				if (info) {
					Swal.fire({
						icon: 'success',
						title: '😃 Información enviada!! 🥳',
						text: 'Tu información ha sido guardada exitosamente, puedes ver tus datos en la sección de perfil de la empresa.',
						confirmButtonText: `Aceptar`
					}).then(()=>{
						location.reload();
					});
				}else {
					Swal.fire({
						icon: 'error',
						title: '😦 Información no registrada!! 😞',
						text: 'Lamentamos este inconveniente, verifica tus datos e intenta nuevamente.',
						confirmButtonText: `Aceptar`
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
		}
	});
});