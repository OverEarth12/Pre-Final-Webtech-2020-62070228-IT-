<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song</title>
    <script src="https://api.spotify.com/v1/search?query=vanilla&type=track&offset=0&limit=20"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <style>
        .song{
            width: 300px;
            border: 1px solid grey;
            display: inline-block;
            margin :20px;
        }
        .info{
            margin: 10px;
        }
    </style>
    <div class="container">
        <div>ระบุคำค้นหา
            <input id="search" name="search" type="text" class="form-control">
            <button class="btn btn-primary" type="submit">ค้นหา</button>
        </div>
    <?php 
        $url = "https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json";
        $response = file_get_contents($url);
        $result = json_decode($response, true);

        $count = 3;

        foreach($result["tracks"]["items"] as $song){
            if($count >= 3){
                $count = 0;
                echo "<div class='row'>";
            }
            echo "<div class='song'><img src=".$song["album"]["images"][0]["url"]." height='300' width='300'>";
            echo "<div class='info col'><b>".$song["album"]["name"]."</b><br>";
            echo "Artist: ".$song["album"]["artists"][0]["name"]."<br>";
            echo "Release date: ".$song["album"]["release_date"]."<br>";
            echo "Avaliable: ".count($song["album"]["available_markets"])." counties";
            echo "</div></div>";
            
            $count++;
            if($count >= 3){
                echo "</div>";
            }
        }

        if(isset($_POST['submit']))
        {
        $from = $_POST['from']; 
        $to = $_POST['to'];
        $search = $_POST['search']; 

        $count = 3;

        foreach($result["tracks"]["items"] as $song){
        if((strpos($song["album"]["name"], $search) === false
        || strpos($song["album"]["artists"][0]["name"], $search) === false)
        || strpos($song["album"]["release_date"]) === false){
            echo "NOT FOUND";
        }else{
            if($count >= 3){
                $count = 0;
                echo "<div class='row'>";
            }
            echo "<div class='song'><img src=".$song["album"]["images"][0]["url"]." height='300' width='300'>";
            echo "<div class='info col'><b>".$song["album"]["name"]."</b><br>";
            echo "Artist: ".$song["album"]["artists"][0]["name"]."<br>";
            echo "Release date: ".$song["album"]["release_date"]."<br>";
            echo "Avaliable: ".count($song["album"]["available_markets"])." counties";
            echo "</div></div>";
            
            $count++;
            if($count >= 3){
                echo "</div>";
            }
        }
            
            
            
        }
    }
    ?>
</body>
</html>