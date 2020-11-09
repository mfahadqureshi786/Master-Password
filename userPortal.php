<?php
session_start();
  if (isset($_SESSION['user']) && time()>=$_SESSION['end'])
    {   
        session_destroy();
        header("location:./index.php");
    }
?>
<!DOCTYPE html>
<html>
<head> 
    <title>Password Manager</title>
    <meta name="charset" value="UTF-8">
    <meta name="viewport" value="width=device-width,initial-scale=1.0">
    
    <style>
        body{
            background-color: #282828;
            font-family: 'Courier New', Courier, monospace;
            
        }
        .container{
            
            width: 50%;
            margin: 100px auto;
            
        }
      
        .container>h4{
            color: white;
            text-align: center;
        }
        .searchDiv>input{
            width: 100%;
            background-color: #4b4b4b;
            color: white;
            border: 0px;
            font-size: 20px;
            padding: 2px;
            margin-bottom: 10px;
        }
        .tabs{
            overflow: hidden;
        }
        .tabs>button:nth-of-type(1){
            margin-right: 5px;
            margin-left: 1%;
        }
        .tabs>button:nth-of-type(2){
            margin-left: 5px;
            margin-right: 1%;
        }
        .tabs>button{
            display: inline;
            float: left;
            background-color:#4b4b4b ;
            color: white;
            font-size: 18px;
            border: 1px solid wheat;
            width: 48%;
            margin: 0px auto;

        }
        .tabs>button:hover{
            background-color: #757575;
        }
        .content{
            display: block;
        }
        .content>table{
            margin-top: 10px;
            width: 100%;
            font-size: 18px;
            color:white;
            border: 2px solid wheat;
        }
        table,thead,th,td{
            color:white;
        }
        .content td{
            padding: 1px;
        }
        .content tbody tr{
            border-bottom: 1px solid wheat;
            padding: 1px;
        }
        tbody td{
            text-align: center;
            font-size: 15px;
        }
        table[name="adder"] td{
         display: block;
         
        }
        table[name="adder"] input,table[name="adder"] button{
            background-color:#4b4b4b;
            border:0px;
            color:white;
            font-size: 20px;
            width: 100%;
            padding: 1px;
        }
        table[name="adder"] td:hover{
            background-color: #757575;
        }
        
        table[name="adder"] button{
            background-color: #8a8787;
        }
        table[name="adder"] button:hover{
        background-color: #8c8b8b;
        }
        
/* Webkit based browsers */
meter{
    width: 100%;
}
meter[value="1"]::-webkit-meter-optimum-value { background: red; }
meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
meter[value="4"]::-webkit-meter-optimum-value { background: green; }

/* Gecko based browsers */
meter[value="1"]::-moz-meter-bar { background: red; }
meter[value="2"]::-moz-meter-bar { background: yellow; }
meter[value="3"]::-moz-meter-bar { background: orange; }
meter[value="4"]::-moz-meter-bar { background: green; }
        .hide{
            display: none;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <?php

        
        if(isset($_SESSION['user']) && $_SESSION['user']==true)
        {  
            echo "<h4>Hi M. Fahad Qureshi!, Your Password Manager is here to serve!</h4>";
        }
        else
        {
            echo "<h4>You are not logged in.</h4>";
            header("location:index.php");
            exit();
        }
        ?>

        
        <div class="searchDiv">
            <input type="text" id="searcher" name="searchBox" placeholder="Search title">
        </div>
        <div class="tabs">
            <button name="view">View Saved</button>
            <button name="add">Add New</button>
        </div>
        <div class="content">
            <table id="mTable" name="manager">
                <thead><tr>
                <th>
                    Title
                </th>
                <th>
                    Url
                </th>
                <th>
                    Username
                </th>
                <th>
                    Password
                </th>
               
                </tr></thead>
                <tbody>
                    <?php
                  
                    if(isset($_SESSION['user']) && $_SESSION['user']==true)
                    {
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "mypasswordmanager";
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) 
                        {
                          //die("Connection failed: " . $conn->connect_error);
                        }
                        else
                        {
                            $sql = "SELECT * from Keeper";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row = $result->fetch_assoc()) 
                                {
                                //echo " " . $row["Title"]. " " . $row["Url"]. " " . $row["Username"]." ".$row["Password"]. "<br>";
                                $title=$row["Title"];
                                $url=$row["Url"];
                                $user=$row["Username"];
                                $pass=$row["Password"];
                                //$tableRow="<tr>"."<td>".$title."</td>"."<td>".$url."</td>"."<td>".$user."</td>"."<td>".$pass."</td>"."</tr>";
                                $tableRow="<tr>"."<td>".$title."</td>"."<td>".$url."</td>"."<td>".$user."</td>"."<td>"."********"."</td>"."</tr>";
                                echo $tableRow;
                                }
                            } 
                            else 
                            {
                            //echo "0 results";
                            } 
                        }


                    }
                    else{
                        header("location:./login.php");
                    }
                
                    ?>
                    
                    
                </tbody>
            </table>
            <table name="adder" class="hide">
                
                    <form method="POST" action="./addNew.php">
                        <tr>
                            <td>
                                <input type="text" name="title"  placeholder="Title" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="url" name="url" placeholder="Url" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="username"  placeholder="Username" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="password" placeholder="Password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <meter name="password-strength-meter"></meter>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="password-strength-text"  disabled>
                            </td>
                        </tr>
                        <tr><td>
                            <button type="submit">Add New Login</button>
                        </td></tr>
                    
                   
                    </form>
            </table>
        </div>
        

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script type="text/javascript">
        var viewTab=document.querySelector(".tabs>button[name='view']");
        var addTab=document.querySelector(".tabs>button[name='add']");
        var contentTableManager=document.querySelector(".content>table[name='manager']");
        var contentTableAdder=document.querySelector(".content>table[name='adder']");
        contentTableAdder.classList.add("hide");
        addTab.addEventListener("click",function(){
            contentTableManager.classList.add("hide");
            contentTableAdder.classList.remove("hide");
        });
        viewTab.addEventListener("click",function(){
            contentTableManager.classList.remove("hide");
            contentTableAdder.classList.add("hide");
        });


var password = document.querySelector('table[name="adder"] input[name="password"]');
var meter = document.querySelector('meter');
var text = document.querySelector('table[name="adder"] input[name="password-strength-text"]');

password.addEventListener('input', function() {
  var val = password.value;
  var result = zxcvbn(val);

  // Update the password strength meter
  meter.value = result.score;
  var strength = {
  0: "Worst",
  1: "Bad",
  2: "Weak",
  3: "Good",
  4: "Strong"
};
  // Update the text indicator
  if (val !== "") {
    text.value = "Strength: " + strength[result.score]; 
  } else {
    text.value = "";
  }
});
var search=document.getElementById("searcher");

search.addEventListener("input",()=>{
    var searchValue=document.getElementById("searcher").value;
    if (search.length != 0) { 
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200 && this.responseText.length>0) {
                console.log("you searched "+searchValue);
                console.log("you searched Response received");
                var resp=this.responseText;
                console.log(resp);
                resp=JSON.parse(resp);
                console.log(resp);
                console.log("Total childs:");
                console.log(document.getElementById("mTable").children[1].children);
                /* if(document.getElementById("mTable").children[1].children.length>0)
                {
                var total=document.getElementById("mTable").children[1].children.length;
                for(var j=0;j<total;j++)
                {document.getElementById("mTable").children[1].children[0].remove();}

                } */
                var mTable=document.getElementById("mTable").children[1];
                
                for(var i=0;i<resp.length;i+=4)
                {
                
                var tr=document.createElement("tr");
                var td1=document.createElement("td");
                td1.appendChild(document.createTextNode(resp[i]));
                var td2=document.createElement("td");
                td2.appendChild(document.createTextNode(resp[i+1]));
                var td3=document.createElement("td");
                td3.appendChild(document.createTextNode(resp[i+2]));
                var td4=document.createElement("td");
                td4.appendChild(document.createTextNode(resp[i+3]));
                tr.appendChild(td1);tr.appendChild(td2);tr.appendChild(td3);tr.appendChild(td4);
                mTable.appendChild(tr);
                
                }
                this.responseText="";
            }
        };
        xmlhttp.open("GET", "search.php?query=" + searchValue, true);
        xmlhttp.send();
        if(document.getElementById("mTable").children[1].children.length>0)
        {
            var total=document.getElementById("mTable").children[1].children.length;
            for(var j=0;j<total;j++)
            {document.getElementById("mTable").children[1].children[0].remove();}

        }
    }
});
    </script>
</body>
</html>
