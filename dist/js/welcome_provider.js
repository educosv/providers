
let arr_data = new FormData();

arr_data.append('carta_checker', true);

fetch('internal_data', {
  method: 'POST',
  body: arr_data
})
.then(res => res.json())
.then(data => {
  if (data)
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
      cancelButtonText: 'Cerrar',
      allowOutsideClick: false
    })
    .then(()=>{
      let arr_dat = new FormData();

      arr_dat.append('cuestionario_checker', true);

      fetch('internal_data', {
        method: 'POST',
        body: arr_dat
      })
      .then(res => res.json())
      .then(data => {
        if (data)
        {
          Swal.fire({
            title: `📑 Homologación activa 📝`,
            imageUrl: 'dist/img/carta.gif',
            imageWidth: 160,
            imageHeight: 160,
            imageAlt: 'Cuestionario de homologación',
            html: `
              <div class="text-center">
                <p>Te informamos que has sido seleccionado/a para participar en nuestro proceso de compra de productos y/o servicios</p>
                <p>Por lo tanto, agradeceremos tu colaboración en llenar el siguiente documento y colgarlo en tu perfil de proveedor</p>
                <p>
                  <a href="https://proveedores.educosv.org/dist/docs/cuestionario_de_homologacion_de_proveedor.pdf" target="_blank">Descargar cuestionario de homologación</a>
                </p>
              </div>
            `,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cerrar',
            allowOutsideClick: false
          });
        }
      });
    });
  }
  else
  {
    let arr_dat = new FormData();

    arr_dat.append('cuestionario_checker', true);

    fetch('internal_data', {
      method: 'POST',
      body: arr_dat
    })
    .then(res => res.json())
    .then(data => {
      if (data)
      {
        Swal.fire({
          title: `📑 Homologación activa 📝`,
          imageUrl: 'dist/img/carta.gif',
          imageWidth: 160,
          imageHeight: 160,
          imageAlt: 'Cuestionario de homologación',
          html: `
            <div class="text-center">
              <p>Te informamos que has sido seleccionado/a para participar en nuestro proceso de compra de productos y/o servicios</p>
              <p>Por lo tanto, agradeceremos tu colaboración en llenar el siguiente documento y colgarlo en tu perfil de proveedor</p>
              <p>
                <a href="http://localhost/providers/dist/docs/cuestionario_de_homologacion_de_proveedor.pdf" target="_blank">Descargar cuestionario de homologación</a>
              </p>
            </div>
          `,
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cerrar',
          allowOutsideClick: false
        });
      }
    });
  }
})
