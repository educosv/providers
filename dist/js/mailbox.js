var d = new Date();
const date = d.getFullYear() + "-" + (d.getMonth() +1) + "-" + d.getDate();

var providerform = document.getElementById('providerform');

providerform.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(providerform);

	arr_data.append('providerform', 'true');
	arr_data.append('office', '1');
	arr_data.append('date', date);

	fetch('https://portal.educo.sv/mailbox/external_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			Swal.fire({
				icon: 'success',
				title: '😃 Success!! 🥳',
				text: 'Tu caso ha sido registrado exitosamente! 👍',
				confirmButtonText: 'Continue..'
			}).then(()=>{
				providerform.reset();
			});
		}else {
			Swal.fire({
				icon: 'error',
				title: '😦 Error! 😞',
				text: 'No se ha podido guardar el caso, verifica los datos e intenta nuevamente.',
				confirmButtonText: 'Continue..'
			});
		}
	});
});