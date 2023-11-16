/*
|-----------------------------------------
|USUARIOS
|-----------------------------------------
*/

$('#users_badge_nombre').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'nombre');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_nombre').show();
      $('#users_badge_nombre').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_email').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'email');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_email').show();
      $('#users_badge_email').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_cargo').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'cargo');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_cargo').show();
      $('#users_badge_cargo').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_permiso').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'permiso');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_permiso').show();
      $('#users_badge_permiso').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_registro').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'tipo_registro');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_registro').show();
      $('#users_badge_registro').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_idioma').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'idioma');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_idioma').show();
      $('#users_badge_idioma').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_imagen').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'imagen');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_imagen').show();
      $('#users_badge_imagen').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_badge_estado').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_users', 'estado');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#users_estado').show();
      $('#users_badge_estado').hide();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

/*
|-----------------------------------------
|SOPORTES
|-----------------------------------------
*/

$('#supports_badge_nombre').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'nombre');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_nombre').show();
      $('#supports_badge_nombre').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_email').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'email');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_email').show();
      $('#supports_badge_email').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_cargo').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'cargo');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_cargo').show();
      $('#supports_badge_cargo').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_permiso').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'permiso');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_permiso').show();
      $('#supports_badge_permiso').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_registro').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'tipo_registro');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_registro').show();
      $('#supports_badge_registro').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_idioma').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'idioma');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_idioma').show();
      $('#supports_badge_idioma').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_imagen').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'imagen');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_imagen').show();
      $('#supports_badge_imagen').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_estado').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'estado');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_estado').show();
      $('#supports_badge_estado').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_asunto').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'asunto');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_asunto').show();
      $('#supports_badge_asunto').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_mensaje').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'mensaje');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_mensaje').show();
      $('#supports_badge_mensaje').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_badge_respuesta').click(() => {
  let arr_data = new FormData();
  arr_data.append('remove_field_supports', 'respuesta');

  var Toast = Swal.mixin({
    toast: false,
    position: 'center',
    showConfirmButton: true
  });

  fetch('internal_data', {
    method: 'POST',
    body: arr_data
  })
  .then(res => res.json())
  .then(data => {
    if (data) {
      $('#supports_respuesta').show();
      $('#supports_badge_respuesta').hide();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible quitar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});