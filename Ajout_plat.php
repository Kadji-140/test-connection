  <?php
// Connexion à la base de données pour récupérer le nombre de plats
require_once "db_connect.php";
try {
    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM plat");
    $stmt_count->execute();
    $nb_plat = $stmt_count->fetchColumn();
} catch (PDOException $e) {
    // En cas d'erreur, ne pas bloquer l'affichage de la page
    $nb_plat = 0;
}
?>
  <!DOCTYPE html>
  <html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="styles.css">
      <title>Ajout de plat et d'ingrédient</title>
  </head>
  <body>
    
      <div class="inscription_content">
          <form action="trait_ajoutplat.php" method="post">
              <h1>Ajout de plat et d'ingrédient</h1>
            
              <?php if (isset($_GET["message"]) && !empty($_GET["message"])) : ?>
                  <div class="info <?= (strpos($_GET["message"], 'succès') !== false) ? 'success' : 'error' ?>">
                      <?= htmlspecialchars($_GET["message"]) ?>
                  </div>
              <?php endif ?>
            
              <div class="form-section">
                  <h2>Informations sur l'ingrédient</h2>
                  <div class="form_group">
                      <label for="nom">Nom de l'ingrédient</label>
                      <input type="text" name="nom" id="nom" required>
                  </div>
                  <div class="form_group">
                      <label for="unite">Unité de mesure</label>
                      <select name="unite_i" id="unite" required>
                          <option value="">Sélectionnez une unité</option>
                          <option value="litre">Litre</option>
                         
                          <option value="unite">Unité</option>
                      </select>
                  </div>
                  
              </div>
            
              <div class="form-section">
                  <h2>Informations sur le plat</h2>
                  <div class="form_group">
                      <label for="nom_plat">Nom du plat</label>
                      <input type="text" name="nom_plat" id="nom_plat" required>
                  </div>
                  <div class="form_group">
                      <label for="id_plat">Identifiant du plat</label>
                      <input type="number" name="id_plat" id="id_plat" required>
                  </div>
                  <!-- <div class="form_group">
                      <label for="description">Description du plat</label>
                      <textarea name="description" id="description" rows="3"></textarea>
                  </div> -->
              </div>
            
              <div class="form_actions">
                  <button type="submit">Enregistrer</button>
                  <button type="button" class="btn-secondary">
    Déjà : <?php 
    if (isset($nb_plat)) {
        echo "Nombre de plats : " . intval($nb_plat);
    } elseif (isset($_GET['nb'])) {
        echo "Nombre de plats : " . intval($_GET['nb']);
    } else {
        echo "Aucun plat";
    }
    ?>
</button>

              </div>
          </form>
      </div>

  </body>
  </html>