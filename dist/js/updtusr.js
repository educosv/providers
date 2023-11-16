var userProfileForm = document.getElementById('user-profile-form');

userProfileForm.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(userProfileForm);

	arr_data.append('updtinfousr', 'true');

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: true
	});

	if (arr_data.get('name') == '' || arr_data.get('position') == '' || arr_data.get('level') == '' || arr_data.get('status') == '')
	{
		Toast.fire({
			icon: 'error',
			title: '😦 Fail! 😞',
			text: 'Ingresa datos válidos',
			confirmButtonText: 'Continue..'
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
					text: 'La información del usuario ha sido actualizada! 👍',
					confirmButtonText: 'Continue..'
				}).then(()=>{
					location.reload();
				});
			}else {
				Toast.fire({
					icon: 'error',
					title: '😦 Fail! 😞',
					text: 'Usuario no actualizado',
					confirmButtonText: 'Continue..'
				});
			}
		});
	}
});