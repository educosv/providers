/*
|-----------------------------------------
|USUARIOS
|-----------------------------------------
*/

$('#users_nombre').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'nombre');

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
      $('#users_nombre').hide();
      $('#users_badge_nombre').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_email').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'email');

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
      $('#users_email').hide();
      $('#users_badge_email').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_cargo').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'cargo');

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
      $('#users_cargo').hide();
      $('#users_badge_cargo').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_permiso').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'permiso');

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
      $('#users_permiso').hide();
      $('#users_badge_permiso').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_registro').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'tipo_registro');

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
      $('#users_registro').hide();
      $('#users_badge_registro').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_idioma').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'idioma');

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
      $('#users_idioma').hide();
      $('#users_badge_idioma').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_imagen').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'imagen');

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
      $('#users_imagen').hide();
      $('#users_badge_imagen').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#users_estado').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_users', 'estado');

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
      $('#users_estado').hide();
      $('#users_badge_estado').show();
      showtable('table_users', 'custom_table_users');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
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

$('#supports_nombre').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'nombre');

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
      $('#supports_nombre').hide();
      $('#supports_badge_nombre').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_email').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'email');

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
      $('#supports_email').hide();
      $('#supports_badge_email').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_cargo').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'cargo');

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
      $('#supports_cargo').hide();
      $('#supports_badge_cargo').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_permiso').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'permiso');

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
      $('#supports_permiso').hide();
      $('#supports_badge_permiso').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_registro').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'tipo_registro');

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
      $('#supports_registro').hide();
      $('#supports_badge_registro').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_idioma').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'idioma');

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
      $('#supports_idioma').hide();
      $('#supports_badge_idioma').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_imagen').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'imagen');

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
      $('#supports_imagen').hide();
      $('#supports_badge_imagen').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_estado').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'estado');

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
      $('#supports_estado').hide();
      $('#supports_badge_estado').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_asunto').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'asunto');

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
      $('#supports_asunto').hide();
      $('#supports_badge_asunto').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_mensaje').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'mensaje');

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
      $('#supports_mensaje').hide();
      $('#supports_badge_mensaje').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});

$('#supports_respuesta').click(() => {
  let arr_data = new FormData();
  arr_data.append('add_field_supports', 'respuesta');

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
      $('#supports_respuesta').hide();
      $('#supports_badge_respuesta').show();
      showtable('table_supports', 'custom_table_supports');
    }else {
      Toast.fire({
        icon: 'error',
        title: '😦 Error! 😞',
        text: 'No fue posible agregar el campo',
        confirmButtonText: `Ok! 👍`
      });
    }
  });
});