<?php require_once('main.php');


// fetch updated player cordinat 
$updatedPlayer = new Player($db);


  $updatedPlayer->slug = isset($_SESSION['slug']) ? $_SESSION['slug'] : die();

  // Get post
  $updatedPlayer->read_single();

  // Create array
  $updatedPlayer_arr = array(
    'id' => $updatedPlayer->id,
    'name' => $updatedPlayer->name,
    'slug' => $updatedPlayer->slug,
    'x' => $updatedPlayer->x,
    'y' => $updatedPlayer->y,
  );

  $gridObj = 50;
  $playerX = $updatedPlayer_arr['x']*$gridObj.'px';
  $playerY = $updatedPlayer_arr['y']*$gridObj.'px';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="../vendor/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <p>Welcome <?php echo $updatedPlayer_arr['name']?></p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="login.php">New Game</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
<?php if(@$gift):?>
<div class="alert alert-primary alert-dismissible fade show w-25" role="alert">
  <strong>You found gift</strong> Allow or cancel
  <hr>
  <button type="button" class="allow btn btn-primary" data-dismiss="alert" aria-label="Close">
    Allow
  </button>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif?>
<?php if(@$enemy):?>
<div class="alert alert-primary alert-dismissible fade show w-25" role="alert">
  <strong>Enemy front of you</strong> fight or run
  <hr>
  <button type="button" class="allow btn btn-primary" data-dismiss="alert" aria-label="Close">
    Fight
  </button>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif?>



   <table id='gameArea'>
    <td id='player' style='left:<?php echo $playerX;?>;top:<?php echo $playerY;?>; transform: rotate(<?php echo $direction;?>)' ></td>
    <?php 
    $mapRow=0;
     foreach ($coordinateArray as $rowCordiante): 
     ?>
        <tr data-rowId='<?php echo $mapRow++?>'>
    <?php
    foreach ($rowCordiante as $colCordinate): ?>
    <?php if ($colCordinate==0): ?>
            <td class='road'></td>
    <?php endif ?>
    <?php if ($colCordinate==1): ?>
            <td class='tree'></td>
    <?php endif ?>
    <?php if ($colCordinate==2): ?>
            <td class='gift'></td>
    <?php endif ?>
    <?php if ($colCordinate==3): ?>
            <td class='enemy'></td>
    <?php endif ?>
    <?php endforeach ?>

        </tr>
    <?php endforeach ?>

    </table>



<div class="controlButtonGroup">
<form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST' >

    <button name='moveup' class='w-100'>UP</button>
    <button name="moveleft" style='width:49%'>LEFT</button>
    <button name="moveright" style='width:49%'>RIGHT</button>
    <button name="movedown" class='w-100'>DOWN</button>
</form>

    </div>
</div>

   





        <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


</body>
</html>