<?php
  class Player {
    // DB Stuff
    private $conn;
    private $table = 'players';

    // Properties
    public $id;
    public $name;
    public $slug;
    public $x;
    public $y;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT *  FROM ' . $this->table;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Players
  public function read_single(){
    // Create query
    $query = 'SELECT * FROM
          ' . $this->table . '
      WHERE slug = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->slug);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->name = $row['name'];
      $this->slug = $row['slug'];
      $this->x = $row['x'];
      $this->y = $row['y'];

  }

  // Create Players
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      name = :name,
      slug =:slug,
      x=:x,
      y=:y';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  $this->slug = htmlspecialchars(strip_tags($this->slug));
  $this->x = htmlspecialchars(strip_tags($this->x));
  $this->y = htmlspecialchars(strip_tags($this->y));


  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':slug', $this->slug);
  $stmt-> bindParam(':x', $this->x);
  $stmt-> bindParam(':y', $this->y);


  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Players
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
    x=:x,
    y=:y
      WHERE
      slug = :slug';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->slug = htmlspecialchars(strip_tags($this->slug));
  $this->x = htmlspecialchars(strip_tags($this->x));
  $this->y = htmlspecialchars(strip_tags($this->y));
  
  
  // Bind data
  $stmt-> bindParam(':slug', $this->slug);
  $stmt-> bindParam(':x', $this->x);
  $stmt-> bindParam(':y', $this->y);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  public function updateX() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
    x=:x
      WHERE
      slug = :slug';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->slug = htmlspecialchars(strip_tags($this->slug));
  $this->x = htmlspecialchars(strip_tags($this->x));
  
  
  // Bind data
  $stmt-> bindParam(':slug', $this->slug);
  $stmt-> bindParam(':x', $this->x);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  public function updateY() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
    y=:y
      WHERE
      slug = :slug';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->slug = htmlspecialchars(strip_tags($this->slug));
  $this->y = htmlspecialchars(strip_tags($this->y));
  
  
  // Bind data
  $stmt-> bindParam(':slug', $this->slug);
  $stmt-> bindParam(':y', $this->y);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Players
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
