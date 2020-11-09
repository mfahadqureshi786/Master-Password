<?php
if(hash('sha256',$_POST['password'])==hash('sha256', "fahad12345")) 
{   
    session_start();
    $_SESSION['user']=true;
    $_SESSION['end']=time()+5*60;
    header("location:userPortal.php");
    echo "<h2>Success</h2>";
    exit();
}
else {
    echo "<h2>Nothing</h2>";
    
    header("location:index.php");
    exit();
}
    

?>