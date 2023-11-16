
/*********************
| Inicializaciones
*********************/

if (!localStorage.getItem('tab-selected'))
	localStorage.setItem('tab-selected', 'prod-tab');

activeTab();

get_activities(0);

$('#prod-tab').click(()=>{ localStorage.setItem('tab-selected', 'prod-tab'); });
$('#service-tab').click(()=>{ localStorage.setItem('tab-selected', 'service-tab'); });

const lista = [];

document.getElementById('initd').min = new Date().toISOString().split("T")[0];

$("#endd").prop('disabled', true);

$("#initd").change(()=>{
	$("#endd").prop('disabled', false);
  	document.getElementById('endd').min = $("#initd").val();
});

$("#proyecto").change(()=>{
  get_activities($("#proyecto").val());
});

/*******************************
| Enviar Solicitud de productos
*******************************/

$('#init-prod').click(()=>{

	if (lista.length > 0)
	{
		let arr_data = new FormData();

		arr_data.append('list', lista);
		arr_data.append('prods_selected', true);

		fetch('internal_data', {
			method: 'POST',
			body: arr_data
		})
		.then(res => res.json())
		.then(data => {
			if (data) {
				location.reload();
			}else {
				Swal.fire({
					icon: 'error',
					title: '😦 Error! 😞',
					text: 'Debes seleccionar al menos un producto para continuar'
				});
			}
		});
	}
	else
	{
		Swal.fire({
			icon: 'error',
			title: '😦 Error! 😞',
			text: 'Debes seleccionar al menos un producto para continuar'
		});
	}

});

/*******************************
| Funciones
*******************************/

function seleccionar (id) {

	let filtro = lista.includes(id);

	var row = `#r${id}`;
	var checkbox = `#chk${id}`;

	if (!filtro)
	{
		lista.push(id);
		$(row).addClass('table-primary');
		$(checkbox).prop('checked', true);
	}
	else
	{
		let index = lista.indexOf(id);
		lista.splice(index, 1);
		$(row).removeClass('table-primary');
		$(checkbox).prop('checked', false);
	}

	console.log('lista: ', lista)
}

function activeTab () {
	let actualTab = localStorage.getItem('tab-selected');

	if (actualTab != 'prod-tab') {
		$('#prod-tab').removeClass('active');
		$('#service-tab').addClass('active');

		$('#prod-req').removeClass('active');
		$('#service-req').addClass('active');
	}
}

function get_activities(id) {

	let arr_data = new FormData();

	arr_data.append('id', id);
	arr_data.append('get_activities', true);

	fetch('internal_data', {
		method: 'POST',
		body: arr_data
	})
	.then(res => res.json())
	.then(data => {
		var html = '';

		$('#actividad').html(html);

		if (data) {
			data.idactivity.forEach(function(val, i) {
				html += `
					<option value="${val}">${data.codactivity[i]} | ${data.description[i]}</option>
				`;
			});

			$('#actividad').html(html);
		}
	});
}

/*
|
| **************************************************************************************************
|
*/


function showTable(arr_data) {
    requestFetch = function() {
        Swal.fire({
            title: '🗃️ Obteniendo datos 📂',
            html: 'No cierre la ventana del navegador.',
            didOpen: () => {
                Swal.showLoading();
            }
        });
        return fetch.apply(this, arguments);
    }

    requestFetch('internal_data', {
        method: 'POST',
        body: arr_data
    }).then((response) => {
        return response.json();
    }).then((data) => {
        Swal.close();
        $('#datable').DataTable( {
            data: data,
            columns:[
            		{data: "no"},
                {data: "codproduct"},
                {data: "description"},
                {
                	data: "price",
                	render: function (data) {
                		return `
                  	$${data}
	                	`;
                	}
                },
                {
                	data: "idprod",
                	render: function (data) {
                		return `
                  	<div class="icheck-primary d-inline">
	                    <input type="checkbox" id="chk${data}">
	                    <label for="chk${data}"></label>
	                  </div>
	                	`;
                	}
                }
            ],
            "createdRow": function( row, data, dataIndex ) {
            	let name = 'r'+data.idprod;
            	let fn = 'seleccionar('+data.idprod+');';
            	$(row).attr('id', name);
            	$(row).attr('onclick', fn);
					  },
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language":
            {
                "emptyTable":           "No hay datos disponibles en la tabla.",
                "info":                 "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty":            "Mostrando 0 registros de un total de 0.",
                "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
                "infoPostFix":          " ",
                "lengthMenu":           "Mostrar &nbsp; _MENU_",
                "loadingRecords":       "Cargando...",
                "processing":           "Procesando...",
                "search":               "Buscar:",
                "searchPlaceholder":    "Dato para buscar",
                "zeroRecords":          "No se han encontrado coincidencias.",
                "paginate":
                {
                    "first":            "Primera",
                    "last":             "Última",
                    "next":             "Siguiente",
                    "previous":         "Anterior"
                },
                "aria":
                {
                    "sortAscending":    "Ordenación ascendente",
                    "sortDescending":   "Ordenación descendente"
                }
            },
            "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]]
        });
    });
}

let arr_data = new FormData();

arr_data.append('prod_list', true);

showTable(arr_data);