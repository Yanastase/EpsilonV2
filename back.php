<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; 
    $file = $_FILES["fileToUpload"];
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    if ($imageFileType !== "png") {
        die("Erreur : Seuls les fichiers PNG sont autorisés.");
    }

    
    $file_mime = mime_content_type($file["tmp_name"]);
    if ($file_mime !== "image/png") {
        die("Erreur : Le fichier n'est pas un véritable PNG.");
    }


    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "Le fichier " . htmlspecialchars($file["name"]) . " a été téléchargé avec succès.";
    } else {
        echo "Erreur lors du téléchargement.";
    }
} else {
    echo "Accès non autorisé.";
}
?>
