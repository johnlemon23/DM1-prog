<!DOCTYPE html>
<html>
  <head>
    <title>Formulaire de commande</title>
  </head>
  <body>
    <h1>Formulaire de commande</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="nom">Nom :</label>
      <input type="text" name="nom" id="nom" required><br><br>
      <label for="adresse">Adresse :</label>
      <textarea name="adresse" id="adresse" required></textarea><br><br>
      <label for="produit">Produit :</label>
     <input type="text" name="produit" id="produit" required><br><br>
      <label for="prix">Prix :</label>
      <input type="number" name="prix" id="prix" required><br><br>
      <input type="submit" value="Envoyer">
    </form>
  </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $produit = $_POST["produit"];
    $prix = $_POST["prix"];

    // Création d'une chaîne de caractère à stocker
    $data = "Nom: $nom\nAdresse: $adresse\nProduit: $produit\nPrix: $prix\n\n";

    // Stockage des informations de la commande dans un fichier texte
    $nomFichier = "commandes.txt";
    file_put_contents($nomFichier, $data, FILE_APPEND);

    // Créeation d'une sauvegarde dans le dossier backup
    $backupDossier = "backup/";
    if (!is_dir($backupDossier)) {
        mkdir($backupDossier, 0777, true);
    }

    $backupNom = $backupDossier . "commandes_backup_" . date("Ymd_His") . ".txt";
    file_put_contents($backupNom, $data);

    echo "Commande enregistrée avec succès.";
}
?>