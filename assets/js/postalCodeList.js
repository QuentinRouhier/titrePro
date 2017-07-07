$(function () {
    //L'evenement blur fonctionne au moment où le champ perd le focus
    $('#postalCode').keyup(function () {
        /**La méthode post attends plusieurs commentaires : 
         * _L'url de la page PHP à executer
         * _Les paramètres à passer en POST
         * _Les actions à effectuer avec le retour du PHP
         * _Le format de donnée utilisé en retour de PHP
         **/
        if ($('#postalCode').val().length >= 2) {
            $.post('../../controller/registerController.php',
                    {
                        search: $('#postalCode').val()
                    },
                    function (data) {
                        //dans data c'est le json généré dans le controlleur grâce à la méthode json_encode
                        response = data.response;
                        $('#city').empty();
                        response.forEach(function (item) {
                          $('#city').append('<option value="' + item.city + '">'  + item.city + '</option>')
                        });
                    },
                    'JSON');
        }
    });
});