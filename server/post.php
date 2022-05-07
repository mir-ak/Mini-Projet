<?php
require 'config.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

// Get the posted data.
if(isset($postdata) && !empty($postdata)){
 
  // Extract the data.
  $request = json_decode($postdata);

  // Extract the data.
  $title =  mysqli_real_escape_string($con,trim($request->data->title));
  $description =  mysqli_real_escape_string($con,trim($request->data->description));
  $published =  mysqli_real_escape_string($con,trim($request->data->published));

  // Create.
  $sql = "INSERT INTO `article`(`title`,`description`,`published`) VALUES ('{$title}','{$description}','{$published}')";

  if(mysqli_query($con,$sql)){
    return http_response_code(201);
    $article = [
      'title' => $title,
      'description' => $description,
      'published' => $published
    ];
    echo json_encode($article);
  }
  else{
    http_response_code(422);
  }
}
?>