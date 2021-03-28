<?php

require_once('models/Model.php');

class PlayerModel extends Model {

    // Gestion des joueurs

    public function newPlayer($nom, $prenom, $licence, $categorie) {
        $sql = "INSERT INTO Effectifs VALUES ('$nom', '$prenom', '$licence', '$categorie')";

        try {
            $this->executeRequest($sql);

            if($licence == "non")
            {
                $sql2 = "INSERT INTO Absences VALUES ('$nom', '$prenom', 'Sans licence', 'N')";

                $this->executeRequest($sql2);
            }

            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été ajouté.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'ajouter le joueur.');</script>";
        }

    }

    public function removePlayer($nom, $prenom) {
        $sql = "DELETE FROM Effectifs WHERE nom = '$nom' AND prenom = '$prenom'";

        try {
            $req = $this->executeRequest($sql);
            if ($req->rowCount() > 0) {
                echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été retiré.');</script>";
            } else echo "<script>alert('Erreur: Impossible de retirer le joueur.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de retirer le joueur.');</script>";
        } 
    }

    public function changePlayer($nom, $prenom, $categorie) {
        $sql = "UPDATE Effectifs SET categorie = '$categorie' WHERE nom = '$nom' AND prenom = '$prenom'";

        try {
            $req = $this->executeRequest($sql);
            if ($req->rowCount() > 0) {
                echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a changé de catégorie.');</script>";
            } else echo "<script>alert('Erreur: Impossible de changer le joueur de catégorie.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de changer le joueur de catégorie.');</script>";
        } 
    }

    public function getPlayer() {
        $sql = "SELECT * FROM Effectifs";

        try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir le joueur.');</script>";
        }

        return $req;
    }

    // Gestion des absents

    public function insertAbsentPlayer($nom, $prenom, $raison, $raisonC,$date) {

        $sql = "INSERT INTO Absences VALUES ('$nom', '$prenom', '$raison', '$raisonC','$date')";

        try {
            $this->executeRequest($sql);

            if($raisonC == 'N')
            {
                $sql2 = "UPDATE Effectifs SET type_licence = 'non' WHERE nom = '$nom' AND prenom = '$prenom'";

                $this->executeRequest($sql2);
            }

            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été ajouté en tant qu\'absent.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d'ajouter le joueur en tant qu\'absent.');</script>";
        }

    }

    public function removeAbsentPlayer($nom, $prenom, $date) {

        $raison = "SELECT raison_court FROM Absences WHERE nom = '$nom' AND prenom = '$prenom' AND date_abs = '$date'";
        $sql = "DELETE FROM Absences WHERE nom = '$nom' AND prenom = '$prenom' AND date_abs = '$date'";

        try {
            $abs = $this->executeRequest($raison)->fetch(PDO::FETCH_NUM);
            $this->executeRequest($sql);

            if($abs[0] == 'N')
            {
                $sql2 = "UPDATE Effectifs SET type_licence = 'oui' WHERE nom = '$nom' AND prenom = '$prenom'";

                $this->executeRequest($sql2);
            }

            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." n\'est plus absent.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de retirer le joueur des absents.');</script>";
        }   
    }

    public function getAbsent() {
        $sql = "SELECT * FROM Absences";

        try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir les absents.');</script>";
        }

        return $req;
    }

    public function getPresent($date) {
        $sql = "SELECT * FROM Effectifs WHERE nom NOT IN (SELECT nom FROM Absences WHERE date_abs = '$date' OR raison_court = 'N') AND prenom NOT IN (SELECT prenom FROM Absences WHERE date_abs = '$date' OR raison_court = 'N')";

        try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur : Impossible d\'avoir les présents.');</script>";
        }

        return $req;
    }

    // Gestion des équipes

    public function newTeam($equipe, $categorie) {
        $sql = "INSERT INTO Equipes VALUES ('$equipe','$categorie')";

        try {
            $this->executeRequest($sql);
            echo "<script>alert('".ucfirst(strtolower($equipe))." - ".ucfirst(strtolower($categorie))." a été créée.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d'ajouter l\'équipe.');</script>";
        }

    }

    public function removeTeam($equipe, $categorie) {
        $sql = "DELETE FROM Equipes WHERE nom_equipe = '$equipe' AND categorie = '$categorie'";

        try {
            $req = $this->executeRequest($sql);
            if ($req->rowCount() > 0) {
                echo "<script>alert('".ucfirst(strtolower($equipe))." - ".ucfirst(strtolower($categorie))." a été retirée.');</script>";
            } else echo "<script>alert('Erreur: Impossible de retirer le joueur.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de retirer l\'équipe.');</script>";
        } 
    }

    public function getTeam() {
        $sql = "SELECT nom_equipe,categorie FROM Equipes";

        try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir les équipes.');</script>";
        }

        return $req;
    }

    public function getCategorie() {
        $sql = "SELECT DISTINCT categorie FROM Equipes";

        try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir les catégories.');</script>";
        }

        return $req;
    }
}

?>
