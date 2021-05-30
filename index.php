<?php error_reporting(E_ERROR | E_PARSE);

    $urlcontent=file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=df4efedbed12d9f0257dc4b63fa63c5f");
    $weatherArray=json_decode($urlcontent,true);

    $weather="";
    $error="";
    if($_GET['city']){

        $_GET['city']=str_replace(" ","",$_GET['city']);

        if($weatherArray['cod']==200){

        $weather="Currently in ".$_GET['city']." it is ".$weatherArray['weather'][0]['description'].".";
        $temp=intval($weatherArray['main']['temp']-273);
        $weather.="The temperature is ".$temp." &deg;C and the wind speed is ".$weatherArray['wind']['deg']."m/s";
        }
        else{
            $error="Could not find the city.";
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Scrapert</title>

    <!--BootStrap Links-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!--Jquery Link-->
  <script src="jquery-ui/jquery-ui.js"></script>
  <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>

    body{
        background-image: url(https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fHRyb3BpY2FsJTIwYmVhY2h8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80);
        background-color: #cccccc;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .container{
       width:500px;
        margin:10% auto;
        text-align: center;
    }
  </style>

</head>

<body>

    <div class="container">
        <h1>What's the Weather?</h1>
        <h5>Enter the name of the city</h5>
    
        <form>
        <div class="form-group">
            <input type="text" class="form-control " id="city" name="city" placeholder="eg. Paris,London" value="<?php echo $_GET["city"];?>" ><br>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        
        <div id="weather">
        <?php
            if($weather){
                echo '<div class="alert alert-success" role="alert">'.$weather;
            }
            else if($error){
                echo '<div class="alert alert-danger" role="alert">'.$error;
            }
        ?>
        
        </div>

    </div>
    
    
</body>
</html>