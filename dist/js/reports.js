
/***********************************
| Total de bitácoras por usuario
************************************/

$('#all1').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate1').attr('disabled','disabled');
        $('#finishdate1').attr('disabled','disabled');
        $('#region1').attr('disabled','disabled');
    }else {
        $('#initdate1').removeAttr('disabled');
        $('#finishdate1').removeAttr('disabled');
        $('#region1').removeAttr('disabled');
    }
});

document.getElementById('initdate1').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate1').max = new Date().toISOString().split("T")[0];

$("#finishdate1").prop('disabled', true);

$("#initdate1").change(()=>{
    $("#finishdate1").prop('disabled', false);
    document.getElementById('finishdate1').min = $("#initdate1").val();
});

/***********************************
| Historico de bitácoras
************************************/

$('#all2').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate2').attr('disabled','disabled');
        $('#finishdate2').attr('disabled','disabled');
        $('#region2').attr('disabled','disabled');
    }else {
        $('#initdate2').removeAttr('disabled');
        $('#finishdate2').removeAttr('disabled');
        $('#region2').removeAttr('disabled');
    }
});

document.getElementById('initdate2').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate2').max = new Date().toISOString().split("T")[0];

$("#finishdate2").prop('disabled', true);

$("#initdate2").change(()=>{
    $("#finishdate2").prop('disabled', false);
    document.getElementById('finishdate2').min = $("#initdate2").val();
});

/***********************************
| Historico de recorridos
************************************/

$('#all3').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate3').attr('disabled','disabled');
        $('#finishdate3').attr('disabled','disabled');
        $('#region3').attr('disabled','disabled');
    }else {
        $('#initdate3').removeAttr('disabled');
        $('#finishdate3').removeAttr('disabled');
        $('#region3').removeAttr('disabled');
    }
});

document.getElementById('initdate3').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate3').max = new Date().toISOString().split("T")[0];

$("#finishdate3").prop('disabled', true);

$("#initdate3").change(()=>{
    $("#finishdate3").prop('disabled', false);
    document.getElementById('finishdate3').min = $("#initdate3").val();
});

/***********************************
| Kms Recorridos por vehículo
************************************/

$('#all4').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate4').attr('disabled','disabled');
        $('#finishdate4').attr('disabled','disabled');
        $('#region4').attr('disabled','disabled');
    }else {
        $('#initdate4').removeAttr('disabled');
        $('#finishdate4').removeAttr('disabled');
        $('#region4').removeAttr('disabled');
    }
});

document.getElementById('initdate4').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate4').max = new Date().toISOString().split("T")[0];

$("#finishdate4").prop('disabled', true);

$("#initdate4").change(()=>{
    $("#finishdate4").prop('disabled', false);
    document.getElementById('finishdate4').min = $("#initdate4").val();
});

/***********************************
| Gastos de mantenimiento
************************************/

$('#all5').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate5').attr('disabled','disabled');
        $('#finishdate5').attr('disabled','disabled');
        $('#region5').attr('disabled','disabled');
    }else {
        $('#initdate5').removeAttr('disabled');
        $('#finishdate5').removeAttr('disabled');
        $('#region5').removeAttr('disabled');
    }
});

document.getElementById('initdate5').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate5').max = new Date().toISOString().split("T")[0];

$("#finishdate5").prop('disabled', true);

$("#initdate5").change(()=>{
    $("#finishdate5").prop('disabled', false);
    document.getElementById('finishdate5').min = $("#initdate5").val();
});

/***********************************
| Consumo de combustible
************************************/

$('#all6').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate6').attr('disabled','disabled');
        $('#finishdate6').attr('disabled','disabled');
        $('#region6').attr('disabled','disabled');
    }else {
        $('#initdate6').removeAttr('disabled');
        $('#finishdate6').removeAttr('disabled');
        $('#region6').removeAttr('disabled');
    }
});

document.getElementById('initdate6').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate6').max = new Date().toISOString().split("T")[0];

$("#finishdate6").prop('disabled', true);

$("#initdate6").change(()=>{
    $("#finishdate6").prop('disabled', false);
    document.getElementById('finishdate6').min = $("#initdate6").val();
});

/***********************************
| Totales de consumo
************************************/

$('#all7').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate7').attr('disabled','disabled');
        $('#finishdate7').attr('disabled','disabled');
        $('#region7').attr('disabled','disabled');
    }else {
        $('#initdate7').removeAttr('disabled');
        $('#finishdate7').removeAttr('disabled');
        $('#region7').removeAttr('disabled');
    }
});

document.getElementById('initdate7').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate7').max = new Date().toISOString().split("T")[0];

$("#finishdate7").prop('disabled', true);

$("#initdate7").change(()=>{
    $("#finishdate7").prop('disabled', false);
    document.getElementById('finishdate7').min = $("#initdate7").val();
});


/***********************************
| Reporte de licencias
************************************/

$('#all8').on('click', function() {
    if ($(this).is(':checked')){
        $('#initdate8').attr('disabled','disabled');
        $('#finishdate8').attr('disabled','disabled');
        $('#region8').attr('disabled','disabled');
    }else {
        $('#initdate8').removeAttr('disabled');
        $('#finishdate8').removeAttr('disabled');
        $('#region8').removeAttr('disabled');
    }
});

document.getElementById('initdate8').max = new Date().toISOString().split("T")[0];
document.getElementById('finishdate8').max = new Date().toISOString().split("T")[0];

$("#finishdate8").prop('disabled', true);

$("#initdate8").change(()=>{
    $("#finishdate8").prop('disabled', false);
    document.getElementById('finishdate8').min = $("#initdate8").val();
});

/***********************************
| Funciones
************************************/

function coming_soon () {
    Swal.fire(
      'Próximamente',
      'Ten paciencia, los reportes están a la vuelta de la esquina.',
      'warning'
    );
}