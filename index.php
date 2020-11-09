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
            
            width: 30%;
            margin: 150px auto;
            
        }
        .container>h2{
            color: white;
            text-align: center;
        }
        form{
            color: white;
            padding: 5px;
            border: 1px solid wheat;
        }
        form>h3{
            text-align: center;
            font-size: 25px;
            margin-bottom: 20px;
        }
        form>input{
            margin: 0px;
            margin-bottom: 20px;
            padding: 0px;
            border: 0px;
            display: block;
            width: 100%;
            color: white;
            background-color: #4b4b4b;
            font-size: 18px;
        }
        form>input:hover{
            background-color: #757575;
        }
        form>button{
            background-color:#4b4b4b ;
            color: white;
            font-size: 18px;
            border: 0px;
            width: 100%;8

        }
        form>button:hover{
            background-color: #757575;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Shshsh! Its Secret!</h2>
        <form method="POST" action="./login.php">
            
            <h3>Password Manager <img src="./keyIcon.png" alt="" style="color: blue;width: 80px;height:25px;"></h3>
            <input type="password" name="password" placeholder="Master_Password">
            <button type="submit">Submit</button>
        </form>

    </div>
</body>
</html>
