<?php
    require_once('../config/Database.php');
    require_once '../models/Player.php';


    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $player = new Player($db);


    $myfile = fopen("file.txt", "r") or die("Unable to open file!");
    $savedCordinates = fread($myfile,filesize("file.txt"));
    fclose($myfile);

    $coordinateArray =[];
    $rowCount=0;
    $colCount=0;
    for ($i=0; $i <strlen($savedCordinates) ; $i++) { 
        if($savedCordinates[$i]=="\n"){
            $colCount=0;
            $rowCount++;
        }else{
            $coordinateArray[$rowCount][$colCount]= $savedCordinates[$i];
            $colCount++;
        }
    }

    $emptySpaces =[];

    for ($i=0; $i < count($coordinateArray); $i++) { 
        for ($z=0; $z < count($coordinateArray[$i]); $z++) { 
            if($coordinateArray[$i][$z]==0){
                $emptySpaces[]=['x'=>$z,'y'=>$i];
            }
        }
    }


    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $slug = $name.'-'.time();

        if(trim($name)!=''){
            $x = $emptySpaces[rand(0,count($emptySpaces)-1)]['x'];
            $y = $emptySpaces[rand(0,count($emptySpaces)-1)]['y'];


            $player->name = $name;
            $player->slug = $slug;
            $player->x = $x;
            $player->y = $y;


            // Create Player
            if($player->create()) {
                $_SESSION['slug']=$slug;
                header('Location:index.php');
            } else {
                echo 'error';
            }
        }
    }



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body class='bg-dark'>

  <div class="container" style='margin-top:150px'>

      <div class="row text-center mt-5 text-white">
          <div class="col-12">
          <h1>Combat Game</h1>
    <h1 class='text-capitalize'>login for starting game</h1>
          </div>
          <div class="col-md-6 offset-md-3 mt-4">
        <form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST'>
            <div class="form-group">
                <label for="exampleInputEmail1">Nick Name</label>
                <input type="text" name='name' class="form-control" id="exampleInputEmail1"  placeholder="Enter nick name">
            </div>
            <button type="submit" name='submit' class="btn btn-warning d-block w-100">Submit</button>
        </form>
          </div>
      </div>
  </div>
   




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>