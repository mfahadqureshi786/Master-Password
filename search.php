<?php
session_start();
 if(isset($_SESSION['user']) && $_SESSION['user']==true)
 {   
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mypasswordmanager";
     
     $var=strtoupper($_GET['query']);
 
     
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) 
     {
       die("Connection failed: " . $conn->connect_error);
     }
     else
     {  
        $sql = "select * from keeper where upper(Title) like '%".$var."%'"." OR "."upper(Url) like '%".$var."%'"." OR upper(Username) like '%".$var."%'";
        $sql=str_replace('"','',$sql);
        //print($sql);
        
        
        $response=array();
        
        $i=0;
        
         $result = $conn->query($sql);
         
         if ($result->num_rows > 0) {
         // output data of each row
            
             while($row = $result->fetch_assoc()) 
             {
             
             $title=$row["Title"];
             $url=$row["Url"];
             $user=$row["Username"];
             $pass=$row["Password"];
            
             $response[$i++]=$title;$response[$i++]=$url;$response[$i++]=$user;$response[$i++]=$pass;
             }
             
             header('Access-Control-Allow-Origin: *');
             header("Content-Type: application/json");
             //$json ="'". json_encode($response)."'";
             $json =json_encode($response);
             echo $json;
             $response="";

         } 
         else 
         {
            echo "";
         } 
     }


 }

?>