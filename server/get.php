<?php
  /**
   * Returns the list of article.
   */
  require 'config.php';
  
  $articles = [];
  $sql = "SELECT id, title, description, published FROM article";
  
  if($result = mysqli_query($con,$sql)){
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
      $articles[$i]['id'] = $row['id'];
      $articles[$i]['title'] = $row['title'];
      $articles[$i]['description'] = $row['description'];
      $articles[$i]['published'] = $row['published'];
      $i++;
    }
    echo json_encode($articles);
    //echo "hey";
  }
  else{
    http_response_code(404);
  }
  
?>  