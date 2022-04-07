<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <style>
        body{
    background: #abbdff;
}
#container{
    width:400px;
    margin:0 auto;
    margin-top:10%;
}
/* Bordered form */
form {
    width:100%;
    padding: 30px;
    border: 1px solid #1c2b4f;
    background: #fff;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
#container h1{
    width: 38%;
    margin: 0 auto;
    padding-bottom: 10px;
}

/* Full-width inputs */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
input[type=submit] {
    background-color: #1c2b4f;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
input[type=submit]:hover {
    background-color: white;
    color: #1c2b4f;
    border: 1px solid #1c2b4f;
}
</style>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="index.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="identifiant" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="motDePasse" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>



        <?php

if(isset($_POST['identifiant']) && isset($_POST['motDePasse']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = 'mot_de_passe_bdd';
    $db_name     = 'nom_bdd';
    $db_host     = 'localhost';
    $db = mysqli_connect('127.0.0.1', 'root', '');  
    if(!$db){
           die('could not connect to database');
}
mysqli_select_db($db, 'pagination'); 
    
$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['identifiant'])); 
$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['motDePasse']));

    
    
    if($_POST['identifiant'] !== "" &&$_POST['motDePasse'] !== "")
    {
        $requete = "SELECT count(*) FROM users where 
              identifiant = '".$username."' and motDePasse = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
          
            
            header('Location: galerie.php');
            
          
          
        }
        else
        {
            echo "utilisateur ou mot de passe incorrect"; // 
        }
    }
    else
    {
        echo "utilisateur ou mot de passe vide";
    }
}
 // fermer la connexion
?>

    </body>
</html>