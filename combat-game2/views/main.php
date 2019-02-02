<?php
    require_once('../config/Database.php');
    require_once('../models/Player.php');

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $player = new Player($db);


  $player->slug = isset($_SESSION['slug']) ? $_SESSION['slug'] : die();

  // Get post
  $player->read_single();

  // Create array
  $player_arr = array(
    'id' => $player->id,
    'name' => $player->name,
    'slug' => $player->slug,
    'x' => $player->x,
    'y' => $player->y,

  );


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

    
    $fullSpaces =[];

    for ($i=0; $i < count($coordinateArray); $i++) { 
        for ($z=0; $z < count($coordinateArray[$i]); $z++) { 
            if($coordinateArray[$i][$z]==1){
                $fullSpaces[]=['x'=>$z,'y'=>$i,'item'=>'border'];
            }else if($coordinateArray[$i][$z]==2){
                $fullSpaces[]=['x'=>$z,'y'=>$i,'item'=>'gift'];
            }else if($coordinateArray[$i][$z]==3){
                $fullSpaces[]=['x'=>$z,'y'=>$i,'item'=>'enemy'];
            }
        }
    }

        $direction ='0deg';
        
    if(isset($_POST['moveright'])){
        $direction='0deg';
         if($player_arr['x']<count($coordinateArray[0])-1 ){
        $newX =$player_arr['x']+1;
        $newY = $player_arr['y'];
         }
    }else if(isset($_POST['movedown'])){
        $direction='90deg';
         if($player_arr['y']<count($coordinateArray)-1){
        $newX =$player_arr['x'];
        $newY = $player_arr['y']+1;
         }
    }else if(isset($_POST['moveup'])){
        $direction='-90deg';
         if( $player_arr['y']>0){
        $newX =$player_arr['x'];
        $newY = $player_arr['y']-1;
         }
    }else if(isset($_POST['moveleft'])){
        $direction='180deg';
        if( $player_arr['x']>0 ){
        $newX =$player_arr['x']-1;
        $newY = $player_arr['y'];
        }
    }
    
    if(isset($newX)){
        $canMove =true;
        $gift=false;
        $enemy=false;
        
        
        foreach ($fullSpaces as $fullS) {
            if($fullS['x']==$newX && $fullS['y']==$newY && $fullS['item']=='border'){
                $canMove=false;
            }else if($fullS['x']==$newX && $fullS['y']==$newY && $fullS['item']=='gift'){
                $canMove=false;
                $gift=true;
            }else if($fullS['x']==$newX && $fullS['y']==$newY && $fullS['item']=='enemy'){
                $canMove=false;
                $enemy=true;
            }
        }
        if($canMove){
            $player->slug = $_SESSION['slug'];
            $player->x = $newX;
            $player->y = $newY;

            if($player->update()) {
            } else {
                echo 'eror';
            }
        }
    
    }
   










?>