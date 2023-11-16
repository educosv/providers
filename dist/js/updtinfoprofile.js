var form = document.getElementById('info-form');

form.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(form);

	arr_data.append('updtUser', 'true');

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: true
	});

	if (arr_data.get('name') == '' || arr_data.get('position') == '')
	{
		Toast.fire({
			icon: 'error',
			title: '😯 Error! ☹️',
			text: 'Ingresa datos válidos',
			confirmButtonText: `De acuerdo 👍`
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
					title: '😃 Success!! 🥳',
					text: 'Información de perfil actualizada.',
					confirmButtonText: `De acuerdo 👍`
				});
			}else {
				Toast.fire({
					icon: 'error',
					title: '😯 Error! ☹️',
					text: 'No se pudo actualizar el usuario.',
					confirmButtonText: `De acuerdo 👍`
				});
			}
		});
	}
});