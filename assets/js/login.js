$(function () {
    //L'evenement click fonctionne au click ou ce situ l'id buttonLogIn
    $('#buttonLogIn').click(function() {
        /**La méthode post attends plusieurs commentaires : 
         * _L'url de la page PHP à executer
         * _Les paramètres à passer en POST
         * _Les actions à effectuer avec le retour du PHP
         * _Le format de donnée utilisé en retour de PHP
         **/
            $.post('../../controller/indexController.php',
                    {
                        verifEmail: $('#email').val(),
                        verifPassword: $('#password').val()
                    },
                    function(data){
                        //dans data c'est le json généré dans le controlleur grâce à la méthode json_encode
                        error = data.error;
                        if(error == true){
                            $('#errorLogin').show();
                            $('#errorLogin').css('color', 'red');
                            $('#errorLogin').css('text-align','center');
                        }else if(error == false){
                            window.location.href = '/index.php';
                        }
                    },
                    'JSON');
    });
});