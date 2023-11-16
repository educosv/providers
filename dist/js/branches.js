
req = 'selecttab';

function selecttab (tab) {
	data = 'nowselecttab='+tab;
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
}

$('#tab-new-branch').click(() => {
	data = 'nowselecttab=new-branch';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

function edit(id) {

	let arr_data = new FormData();

	arr_data.append('id', id);
	arr_data.append('infobranch', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		$('#edit-branch').modal('show');
		$('#editbranch').val(data.branch);
		$('#btn_editbranch').val(data.idbranch);
	});
}

function change(id, status) {

	let arr_data = new FormData();

	arr_data.append('id', id);
	arr_data.append('status', status);
	arr_data.append('ch_branch_status', true);

	if (status === 1) {
		var titulo = '¿Deseas desactivar este rubro?';
		var mnsj = 'No podrás visualizarla en ningún formulario.';
		var confirm = 'Desactivar rubro';
		var color = '#F85656';
	}else {
		var titulo = '¿Deseas activar este rubro?';
		var mnsj = 'Aparecerá en todos los formularios que visualices.';
		var confirm = 'Activar idioma';
		var color = '#45B25D';
	}

	Swal.fire({
        icon: 'question',
        title: titulo,
        html: mnsj,
        showCancelButton: true,
        confirmButtonText: confirm,
        confirmButtonColor: color,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('internal_data', {
                method: 'POST',
                body: arr_data
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    Swal.fire({
                        icon: 'success',
                        title: '😃 rubro actualizado!! 🥳',
                        confirmButtonText: `Genial! 👍`
                    }).then(()=>{
                        location.reload();
                    });
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: '😦 Error 😞',
                        html: 'No se logró actualizar el rubro, intentalo nuevamente.',
                        confirmButtonText: `Ok! 👍`
                    }).then(()=>{
                        location.reload();
                    });
                }
            });
        } else if (result.isDenied) {
            Swal.fire('Acción cancelada', '', 'info');
        }
    });
}

$('#btn_editbranch').click(() => {
	let arr_data = new FormData();

	arr_data.append('editbranch', true);
	arr_data.append('branch', $('#editbranch').val());
	arr_data.append('id', $('#btn_editbranch').val());

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			Swal.fire({
				icon: 'success',
				title: '😃 Rubro Actualizado! 🥳',
				confirmButtonText: `Genial! 👍`
			}).then(() => {
				location.reload();
			});
		}else {
			Swal.fire({
				icon: 'error',
				title: '😦 Rubro no actualizado 😞',
				html: '<p>Por favor verifica los datos e intenta nuevamente.</p>',
				confirmButtonText: `De acuerdo! 👍`
			}).then(() => {
				location.reload();
			});
		}
	});
});

var new_form = document.getElementById('new_form');

new_form.addEventListener('submit', (e) => {
	e.preventDefault();

	let arr_data = new FormData(new_form);

	arr_data.append('new_branch', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		if (data) {
			Swal.fire({
				icon: 'success',
				title: '😃 Rubro registrado! 🥳',
				confirmButtonText: `Genial! 👍`
			}).then(() => {
				location.reload();
			});
		}else {
			Swal.fire({
				icon: 'error',
				title: '😦 Rubro no registrado 😞',
				html: '<p>Por favor verifica los datos e intenta nuevamente.</p>',
				confirmButtonText: `De acuerdo! 👍`
			}).then(() => {
				location.reload();
			});
		}
	});
});