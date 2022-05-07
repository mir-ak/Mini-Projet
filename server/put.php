<?php
require 'config.php';
$postdata = file_get_contents("php://input");
// Get the posted data.
if(isset($postdata) && !empty($postdata)){

  // Extract the data.
  $request = json_decode($postdata);
  /* $id    = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $published = $_POST['published']; */

  $id    = mysqli_real_escape_string($con,(int)$request->data->id);
  $title = mysqli_real_escape_string($con,trim($request->data->title));
  $description = mysqli_real_escape_string($con,trim($request->data->description));
  $published = mysqli_real_escape_string($con,trim($request->data->published));

  // Update.
  $sql = "UPDATE `article` SET `title`='$title',`description`='$description' ,`published`='$published'  WHERE `id` = '{$id}' LIMIT 1";

  if(mysqli_query($con, $sql)){
    $article = [
      'id' => $id,
      'title' => $title,
      'description' => $description,
      'published' => $published
    ];
    echo json_encode($article);
    return header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  
  }
  else{
    return header("HTTP/1.1 404 Not Found");;
  }  
}
?>