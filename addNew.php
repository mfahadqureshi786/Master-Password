<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user']==true){
$title=strval($_POST['title']);
$url=strval($_POST['url']);
$user=strval($_POST['username']);
$pass=hash('sha256',strval($_POST['password']));
if(isset($title) && isset($url)  && isset($user) && isset($pass))
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mypasswordmanager";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO Keeper (Title, Url, Username, Password) VALUES ("."'".$title."'".","."'".$url."'".","."'".$user."'".","."'".$pass."'".")";
    
    if ($conn->query($sql) === TRUE) {
      //echo "New record created successfully";
      header("location:userPortal.php");
    } else {
        echo "</br>".$title." ".$url." ".$user." ".$pass."</br>";
      //echo "Error: " . $sql . "<br>" . $conn->error;
      header("location:userPortal.php");
    }
    $conn->close();
}


/* 
$sql = "SELECT * from Keeper";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo " " . $row["Title"]. " " . $row["Url"]. " " . $row["Username"]." ".$row["Password"]. "<br>";
  }
} else {
  echo "0 results";
} */
}
?>