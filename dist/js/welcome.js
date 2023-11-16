let arr_data = new FormData();

arr_data.append('carta_checker', true);

fetch('internal_data', {
  method: 'POST',
  body: arr_data
})
.then(res => res.json())
.then(data => {
  if (!data)
  {
    Swal.fire({
      title: `📑 Carta de compromiso 📝`,
      imageUrl: 'dist/img/carta.gif',
      imageWidth: 160,
      imageHeight: 160,
      imageAlt: 'Carta de compromiso',
      html: `
        <div class="text-center">
          Gracias por ser parte de nuestro equipo Educo.<br>
          Agradecemos tu colaboración en llenar tu carta de compromiso la cual puedes descargar <a href="https://proveedores.educosv.org/dist/docs/carta_de_compromiso.pdf" target="_blank"><strong>dando clic aquí</strong></a>
        </div>
      `,
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'No volver a mostrar',
      allowOutsideClick: false
    }).then((result) => {
      if (result.dismiss)
      {
        var arr_data = new FormData();

        arr_data.append('add_carta_noti', true);

        fetch('internal_data', {
          method: 'POST',
          body: arr_data
        })
        .then(res => res.json())
        .then(data => {
          if (data)
          {
            Swal.fire('Acción cancelada', '', 'info');
          }
          else
          {
            Swal.fire('Error', '', 'error');
          }
        });
      }
    });
  }
});