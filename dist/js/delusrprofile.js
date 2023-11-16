$("#userdel").hide();

$("#delphrase").keyup(() => {

	let arr_data = new FormData();

	arr_data.append('phrase', $("#delphrase").val());
	arr_data.append('valphrase', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			$("#userdel").show();
		}else {
			$("#userdel").hide();
		}
	});
});

$("#userdel").click(() => {

	let arr_data = new FormData();

	arr_data.append('phrase', $("#delphrase").val());
	arr_data.append('deluser', true);

	var Toast = Swal.mixin({
		toast: false,
		position: 'center',
		showConfirmButton: false,
		timer: '2000',
		timerProgressBar: true
	});

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			let url = window.location['href']+'?req=users';
			window.open(url,'_self');
		}else {
			Toast.fire({
				icon: 'error',
				title: '😦 Fail! 😞',
				text: 'No se pudo eliminar el usuario'
			});
			$("#userdel").hide();
			$("#delphrase").val('');
			$("#modal_del").modal('hide');
		}
	});
});