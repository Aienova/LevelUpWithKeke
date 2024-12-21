$('form').submit(function(e){


    var action = $(".theform").attr("data-action");
    console.log("action :"+action);


    console.log("submit.js - route :"+action);

                e.preventDefault();
                $.ajax({
                    url: './'+action,
                    type: 'POST',
                    data:$('form').serialize(),
                    success: function(data) {
            
                        $('.theform').html(data);

                      /*  $('#notification').addClass("popup");
                        setTimeout(function() {

                        $('#notification').removeClass('popup');

                        },2500); */
                            
                                            },
                    error: function() {
                        $('#notification').text('Erreur au niveau du formulaire');
                    }


                });


                });
