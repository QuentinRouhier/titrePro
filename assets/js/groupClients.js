$( "#group" ).ready(function() {
  if ($('#group').val() == 1) {
        $('#divSociety').removeClass('hidden');
        $('#divDescribeSociety').removeClass('hidden');
    } else {
        $('#divSociety').addClass('hidden');
        $('#divDescribeSociety').addClass('hidden');
    }
});

$('#group').change(function () {
    if ($('#group').val() == 1) {
        $('#divSociety').removeClass('hidden');
        $('#divDescribeSociety').removeClass('hidden');
    } else {
        $('#divSociety').addClass('hidden');
        $('#divDescribeSociety').addClass('hidden');
    }
}); 
