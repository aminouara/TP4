


<?php
 
//Téléversemnt 
if(!empty($_FILES)){
    require("imgClass.php");
    $img = $_FILES['img'];
    $extension=  strtolower(substr($img['name'], -3));
    $allow_ext = array("jpg", "png" , 'jpeg');
    $size = $img['size'];
    if( in_array($extension , $allow_ext)) {
        move_uploaded_file($img['tmp_name'],"upload/".$img['name']);
        Image::imageRedimention("upload/".$img['name'],"upload/min",$img['name'],215,112);
    }
    else {
       echo "Le fcher n'est pas autoriser";
    }

}
?>




<?PHP
    //On teste si le formulaire a été soumis
        if (isset($_POST['Valider']))
        {
        
        //on se connecte au srveur
        $conn = mysqli_connect('127.0.0.1', 'root', '');  

    if (! $conn) {  

        die("Connection failed" . mysqli_connect_error());  

    }
    // on selectionne la base de données
    mysqli_select_db($conn, 'pagination'); 
    
    //on insere les données  dans la table 
    $extension=  strtolower(substr($img['name'], -3));
    $size = $img['size'];
    $nom=basename($img['name'],'.'.$extension);
   
    $chemin = "upload/min/".$img['name'];
    $sql=" INSERT INTO `galerie` (`id`, `nom`, `chemin`,`taille`, `extension`)
    VALUES('','$nom','$chemin','$size','$extension')";

    if (!mysqli_query($conn,$sql))
    {
    die('impossible d’ajouter cet enregistrement : ' .  mysqli_connect_error());
    }
    //echo "L’enregistrement est ajouté ";
    mysqli_close($conn);
    }
    $conn = mysqli_connect('127.0.0.1', 'root', '');  
    mysqli_select_db($conn, 'pagination'); 
    
    

    //pagination
    $limit = 6;  
    
    $result = mysqli_query($conn, "SELECT  DISTINCT * FROM galerie");  

    $total_rows = mysqli_num_rows($result);    

    if (!isset ($_GET['page']) ) {  

        $page_number = 1;  

    } else {  

        $page_number = $_GET['page'];  

    }    
  
    $initial_page = ($page_number-1) * $limit;   
    $total_pages = ceil($total_rows / $limit);



  //supprission  
 
if(isset($_GET['id'])){

$id= $_GET['id'];
mysqli_query($conn, "DELETE FROM galerie WHERE ID=$id");

}
?>




  
    
<?php
//affichage de la galerie 
   
   

    $getQuery = "SELECT DISTINCT *  FROM galerie LIMIT " . $initial_page . ',' . $limit; 
     

    $result = mysqli_query($conn, $getQuery);  
    


   
   echo "<table align=\"center\" >";
    echo "<tr>";
       
    $i=1;
    while ($row = mysqli_fetch_array($result)) {  
   
    
       
if($i % 2 == 0) {
   
   
                    echo "<td>"; 
    ?> 
                
                    <a href="galerie.php?click=1"><img style="border-color:#000000;" border="5"  width="215" height="112" src= " <?php echo  $row['chemin'] ?>"    /></a>
                    <?php
                    
                    echo "<br>";
                    
                     echo "<strong>Nom</strong> :" .$row['nom']; 
                    echo "    ";
                    echo "<strong>Taille</strong> : ".$row['taille'];
                    echo "<br>";
                    echo '<a class ="button" href ="?id=',$row['ID'],'">Supprimer</a>';
                    echo "</td>";
                    echo "<tr>";
                    echo "<br>";
                    $i = $i+1;
                    
            }
            else{
            
              
        
                echo "<td>"; 
                ?> 
                   
                            
                                <a href="galerie.php?click=1"><img style="border-color:#000000;" border="5"  width="215" height="112" src= " <?php echo  $row['chemin'] ?>"    /></a>
                                <?php
                                echo "<br>";
                                echo "<strong>Nom</strong> :" .$row['nom'];
                                echo "    ";
                                echo "<strong>Taille</strong> : ".$row['taille'];
                                echo "<br>";
                                echo '<a class ="button" href ="?id=',$row['ID'],'">Supprimer</a>';
                                echo "</td>";
                                $i = $i+1;
                                
                                
            }
          }
            
                               
               
        
        echo "</tr>"; 
   echo "</table>";


  
   
   ?>    
 
    
    
    <div Align=Center>
    <?php
 if ($page_number-1 > 0){
  echo "<a href='galerie.php?page=".($page_number-1)."'class='button' >Previous</a>"; 
   }
  echo "       ";
  for ($i=1; $i<=$total_pages; $i++) {  
      echo "<a href='galerie.php?page=" .$i.  "  '>"  .$i. "</a>";
      echo "  ";
  }
  echo "       ";
  if ($page_number < $total_pages){
  echo "<a href='galerie.php?page=".($page_number+1)."' class='button'>Next</a>";
  }  
?>
</div>

<html>
    
 
   <body>
   <div Align=Center>
   <form enctype="multipart/form-data" action="galerie.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
     <input name="img" type="file" />
    <input type="submit" name="Valider" value="Envoyer"  />
    
</div>
</form>


    </body>
</html>
