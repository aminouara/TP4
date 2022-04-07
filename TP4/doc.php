
   


  <P>
  <B>DEBUTTTTTT DU PROCESSUS :</B>
  <BR>
  <?php echo " ", date ("h:i:s"); ?>
  </P>



  
  <?php
  
  function before ($a, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $a));
    };


    

  
  set_time_limit (500);
  $path= "docs";
  
  
  
  function explorerDir($path)
  {
     
  
    $folder = opendir($path);
    
    
    while($entree = readdir($folder))
    {		
      //
      echo $entree ;
      echo "</br>";
      if($entree != "." && $entree != "..")
      {
        //
        if(is_dir($path."/".$entree))
        {
          //
          $sav_path = $path;
          //
          $path .= "/".$entree;
          //			
          explorerDir($path);
          //
          $path = $sav_path;
        }
        else
        {
          //
          $path_source = $path."/".$entree;				
          
          $allow_ext = array("jpg", "png" , 'jpeg');
          $extension=  strtolower(substr($path_source , -3));
          if( in_array($extension , $allow_ext)){
    
    
     
      //echo $path_source;
    
      //echo "</br>";
      
      
        }
      }
    }
  }
    closedir($folder);
    
  }
  explorerDir($path);
  
  ?>
  <P>
  <B>FINNNNNN DU PROCESSUS :</B>
  <BR>

  <?php echo " ", date ("h:i:s"); ?>
  </P>


<?php


