
$(function () {
    bsCustomFileInput.init();
});

req = 'selecttab';

$.ajax({
	type: 'post',
	url: 'internal_data',
	data: req
}).done(function(idtab){
	$('a[href="#'+idtab+'"]').tab('show');
});

$('#profile-general-tab').click(() => {
	data = 'usrprofileselecttab=general';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

$('#profile-info-tab').click(() => {
	data = 'usrprofileselecttab=info';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

$('#profile-docs-tab').click(() => {
	data = 'usrprofileselecttab=docs';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

$('#profile-various-tab').click(() => {
	data = 'usrprofileselecttab=various';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

$('#profile-homologaciones-tab').click(() => {
	data = 'usrprofileselecttab=homologaciones';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

$('#profile-reports-tab').click(() => {
	data = 'usrprofileselecttab=reports';
	$.ajax({
		type: 'post',
		url: 'internal_data',
		data: data
	});
});

// ---------------------------------------------------------------------------------------------------------