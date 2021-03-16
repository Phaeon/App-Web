<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
		<fieldset>

		<legend>Transférez un fichier CSV</legend>

		<label>Choisissez un fichier : </label><br>
		<input type="file" name="fichier" /> 
		<input type="submit" value="Transférer"/>



		</fieldset>

	</form>

	<?php
    // Si le fichier a été déposé, on l'analyse
    if(isset($_FILES['fichier'])){
        
        $file_name = $_FILES['fichier']['name'];
      	$file_size = $_FILES['fichier']['size'];
      	$file_ext=strtolower(end(explode('.',$_FILES['fichier']['name'])));
      
      	$extensions = array("zip");
      
        // On vérifie si c'est bien un fichier CSV
      	if($file_ext != "csv"){
         	echo "Extension non autorisé, veuillez sélectionner un fichier CSV.";
         	exit();
      	}
      
      	if($file_size > 2097152){
         	echo 'Fichier trop volumineux (> 2 MB)';
         	exit();
      	}
        
        $file_tmp = $_FILES['fichier']['tmp_name'];
      	move_uploaded_file($file_tmp,"upload/".$file_name);
        
        $file = "upload/$file_name";
        
        // Importer les données du CSV
        if(file_exists($file) ) {
            if($id_file=fopen($file,"a")) {
                
                flock($id_file,3);
                
                // Analyser chaque ligne
                while($tab=fgetcsv($id_file,200,";") ) {
                    // Dans le cas où le nombre de champs n'est pas valide
                    if (count($tab) != 5) {
                        exit();
                    }
                    $nom = $tab[0];
                    $prenom = $tab[1];
                    $licence = $tab[2];
                    $equipe = $tab[3];
                    $categorie = $tab[4];
                    
                    // Si la personne n'est pas dans la base, l'insérer
                    if (!$playerCtrl->playerExists($nom, $prenom)) {
                        $playerCtrl->insertPlayer($nom, $prenom, $licence, $equipe, $categorie);
                    }
                }
                
                fclose($id_file);
            }
        } else {
            echo "Fichier inaccessible.";
        }
        
    }
?>
    
    </body>
</html>