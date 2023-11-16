
const form = document.getElementById("upload-form");

const carta = document.getElementById("upload-carta");

const cuestionario = document.getElementById("upload-cuestionario");

form.addEventListener('submit', async (e) => {

    e.preventDefault();

    let arr_data = new FormData(form);

    arr_data.append('uploadfile', 'true');

    Swal.fire({
        title: '🛫 Subiendo archivo 🛬',
        html: 'No cierre la ventana del navegador.',
        didOpen: () => {
            Swal.showLoading()
        }
    });

    const result = await fetch('internal_data', {
        method: 'POST',
        body: arr_data
    });

    if (result) {
        Swal.fire({
            icon: 'success',
            title: '😃 Archivo enviado!! 🥳',
            text: 'Tu archivo ha sido cargado exitosamente.',
            confirmButtonText: `Genial! 👍`
        }).then(()=>{
            location.reload();
        });
    }else {
        Swal.fire({
            icon: 'error',
            title: '😦 Archivo no enviado!! 😞',
            text: 'Lamentamos este inconveniente, verifica tus datos e intenta nuevamente.',
            confirmButtonText: `Ok! 👍`
        })
        .then(()=>{
            $('#filename_form').val('');
            $('#archivo_form').val('');
        });
    }
});

carta.addEventListener('submit', async (e) => {

    e.preventDefault();

    let arr_data = new FormData(carta);

    arr_data.append('uploadcarta', 'true');

    Swal.fire({
        title: '🛫 Subiendo archivo 🛬',
        html: 'No cierre la ventana del navegador.',
        didOpen: () => {
            Swal.showLoading()
        }
    });

    const result = await fetch('internal_data', {
        method: 'POST',
        body: arr_data
    });

    if (result) {
        Swal.fire({
            icon: 'success',
            title: '😃 Archivo enviado!! 🥳',
            text: 'Tu archivo ha sido cargado exitosamente.',
            confirmButtonText: `Genial! 👍`
        }).then(()=>{
            location.reload();
        });
    }else {
        Swal.fire({
            icon: 'error',
            title: '😦 Archivo no enviado!! 😞',
            text: 'Lamentamos este inconveniente, verifica tus datos e intenta nuevamente.',
            confirmButtonText: `Ok! 👍`
        })
        .then(()=>{
            $('#filename_carta').val('');
            $('#archivo_carta').val('');
        });
    }
});

cuestionario.addEventListener('submit', async (e) => {
    e.preventDefault();

    let arr_data = new FormData(cuestionario);

    arr_data.append('add_quiz', 'true');

    Swal.fire({
        title: '🛫 Subiendo archivo 🛬',
        html: 'No cierre la ventana del navegador.',
        didOpen: () => {
            Swal.showLoading()
        }
    });

    const result = await fetch('internal_data', {
        method: 'POST',
        body: arr_data
    });

    if (result) {
        Swal.fire({
            icon: 'success',
            title: '😃 Archivo enviado!! 🥳',
            text: 'Tu archivo ha sido cargado exitosamente.',
            confirmButtonText: `Genial! 👍`
        }).then(()=>{
            location.reload();
        });
    }else {
        Swal.fire({
            icon: 'error',
            title: '😦 Archivo no enviado!! 😞',
            text: 'Lamentamos este inconveniente, verifica tus datos e intenta nuevamente.',
            confirmButtonText: `Ok! 👍`
        })
        .then(()=>{
            $('#filename_quiz').val('');
            $('#archivo_quiz').val('');
        });
    }
});


/* DOWNLOAD */

const delfile = (idfile) => {

    let arr_data = new FormData();

    arr_data.append('idfile', idfile);
    arr_data.append('delfile', true);

    Swal.fire({
        title: '¿Realmente deseas eliminar este documento?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Eliminar',
        denyButtonText: 'Cancelar'
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
                        title: '😃 Archivo eliminado!! 🥳',
                        confirmButtonText: `Genial! 👍`
                    }).then(()=>{
                        location.reload();
                    });
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: '😦 Error 😞',
                        text: 'No se logró eliminar el archivo, intentalo nuevamente.',
                        confirmButtonText: `Ok! 👍`
                    });
                }
            });
        } else if (result.isDenied) {
            Swal.fire('Acción cancelada', '', 'info')
        }
    });


}