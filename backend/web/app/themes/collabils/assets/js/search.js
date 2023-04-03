$(function() {
  var $searchForm = $('.search-form');
  var $searchInput = $('#search-input');
  var $searchButton = $('#search-button');
  var $signsContainer = $('.display-signs-container');

  $searchForm.on('submit', function(e) {
    e.preventDefault();

    // Récupérer la valeur de la recherche
    var query = $searchInput.val();

    // Envoyer la requête de recherche via AJAX
    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      method: 'POST',
      data: {
        action: 'search_signes',
        query: query
      },
      success: function(response) {
        // Mettre à jour l'affichage avec les résultats
        $signsContainer.html(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error(errorThrown);
      }
    });
  });
});
