$(function () {
    //L'evenement keyup fonctionne au moment où on click sur une touche de notre clavier
    $('#placeOfDeparture').keyup(function () {
        /**La méthode post attends plusieurs commentaires : 
         * _L'url de la page PHP à executer
         * _Les paramètres à passer en POST
         * _Les actions à effectuer avec le retour du PHP
         * _Le format de donnée utilisé en retour de PHP
         **/
        if ($('#placeOfDeparture').val().length >= 1) {
            $.post('../../controller/indexController.php',
                    {
                        searchPlaceOfDeparture: $('#placeOfDeparture').val()
                    },
                    function (data) {
                        //dans data c'est le json généré dans le controlleur grâce à la méthode json_encode
                        response = data.response;
                        $('#placeDeparture').empty();
                        response.forEach(function (item) {
                            $('#placeDeparture').append('<option value="' + item.city + ' -> ' + item.postalCode + '">' + item.city + ' -> ' + item.postalCode + '</option>')
                        });
                    },
                    'JSON');
        }
    });
    $('#arrivalPoint').keyup(function () {
        /**La méthode post attends plusieurs commentaires : 
         * _L'url de la page PHP à executer
         * _Les paramètres à passer en POST
         * _Les actions à effectuer avec le retour du PHP
         * _Le format de donnée utilisé en retour de PHP
         **/
        if ($('#arrivalPoint').val().length >= 1) {
            $.post('../../controller/indexController.php',
                    {
                        searchArrivalPoint: $('#arrivalPoint').val()
                    },
                    function (data) {
                        //dans data c'est le json généré dans le controlleur grâce à la méthode json_encode
                        response = data.response;
                        $('#destination').empty();
                        response.forEach(function (item) {
                            $('#destination').append('<option value="' + item.city + ' -> ' + item.postalCode + '">' + item.city + ' -> ' + item.postalCode + '</option>')
                        });
                    },
                    'JSON');
        }
    });
});