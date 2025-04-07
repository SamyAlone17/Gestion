function execute_form_ajax(idform) {

  $('#' + idform).submit(function (event) {
    // Empêcher le formulaire de soumettre normalement
    event.preventDefault();
    let names_input = []
    var form_action = $(this).attr("action")

    // Récupérer les données du formulaire
    var formData =new FormData($('#' + idform)[0])// $(this).serialize();
     console.log("formulaire en soumission!...");
     console.log(formData);
    // Envoyer les données en POST à un fichier PHP
    jQuery.ajax({
      type: 'POST',
      url: form_action, // Remplacez 'traitement.php' par le chemin de votre fichier PHP de traitement
      data: formData,
      processData: false,  // Empêchez jQuery de traiter les données
      contentType: false, 
      success: function (response) {
        var $inputs = $('#' + idform).find('input, textarea, select')

        $inputs.each(function () {
          console.log($(this).attr("name"))
          $(this).parent("div").find("span").empty()
          $(this).removeClass("border-danger")
        });
        // Gérer la réponse du serveur
        console.log(response)
        response = JSON.parse(response)
        // reponse de sucess
        if (response.status == 200) {
          if (response.hasOwnProperty("redirect")) {
            window.location.href = response.redirect
          }else{
            swal("Successed!",response.message, "success")
            setTimeout(() => {
              window.location.reload()
            }, 1000);
          }
        } else {
          console.log(response);
          // erreur lies a la logique ou a la securiter 
          if (response.status == 400) {
            swal(response.error, "", "error")
          } else {
          // erreur lies regle des champs de formulaire 
            var $inputs = $('#' + idform).find('input, textarea, select')

            response = response.error
            $inputs.each(function () {
              console.log($(this).attr("name"))
              if (response.hasOwnProperty($(this).attr("name"))) {
                $(this).addClass("border-danger")
                $(this).parent("div").append("<span class='text-danger ' >" + response[$(this).attr("name")] + "</span>")
              }

            });
          }       // Faire d'autres actions en fonction de la réponse
        }
      },
      error: function (xhr, status, error) {
        // Gérer les erreurs de la requête AJAX
        console.error(xhr.responseText); // Afficher l'erreur dans la console
      }
    });
  });
} 
