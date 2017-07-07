$( "#group" ).ready(function() {
  if ($('#group').val() == 1) {
        $('#divSociety').removeClass('hidden');
    } else {
        $('#divSociety').addClass('hidden');
    }
});

$('#group').change(function () {
    if ($('#group').val() == 1) {
        $('#divSociety').removeClass('hidden');
    } else {
        $('#divSociety').addClass('hidden');
    }
}); 
