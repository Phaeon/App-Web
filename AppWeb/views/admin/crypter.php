
<?php
require_once('models/Model.php');
require_once('controlers/HomeControler.php');


class T extends Model {
    
    private $_mainCtrl;
    
    public function __construct($login, $sql) {
        $t = "select login from Utilisateurs where login=?";
        $req = $this->executeRequest($t, array($login));
        
        if ($req->rowCount() == 1) echo "Login déjà existant";
        else {
            $this->executeRequest($sql);
            $mdp = $this->executeRequest("SELECT mdp FROM Utilisateurs WHERE login = '$login'");
            echo $mdp->fetchColumn(0);
        }
        
        $this->_mainCtrl = new HomeControler();
    }
}

if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['role']))
{
    $login = $_POST['login'];
    $pass_crypte = password_hash($_POST['pass'], PASSWORD_DEFAULT); // On crypte le mot de passe
    $role = $_POST['role'];

    $sql = "INSERT INTO Utilisateurs(login, mdp, role) values('$login', '$pass_crypte', '$role')";
    
    try {
        $m = new T($login, $sql);
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}
else // On n'a pas encore rempli le formulaire
{
?>

<p>Entrez votre login et votre mot de passe pour le crypter.</p>

<form method="post">
    <p>
        Login : <input type="text" name="login"><br />
        Mot de passe : <input type="text" name="pass"><br /><br />
        
        <select name="role">
            <option value="Secrétaire">Secrétaire</option>
            <option value="Entraîneur">Entraîneur</option>
        </select>
    
        <input type="submit" value="Crypter !">
    </p>
</form>

<?php
}
?>
