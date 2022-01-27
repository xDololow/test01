<?php
include('dbData.php');

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
}


$posts = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/posts'));
$comments = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/comments'));

$db_counts = [
    "posts" => 0,
    "comments" => 0,
];


foreach ($posts as $post){
    
    $sql = "INSERT INTO testdb.posts (userId, title, body) VALUES ('". $post->userId ."', '". $post->title ."', '". $post->body ."')";
    if (mysqli_query($conn, $sql)) {
        ++$db_counts["posts"];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die();
    }
}

foreach ($comments as $comment){
    
    $sql = "INSERT INTO testdb.comments (postId, name, email, body) VALUES ('". $comment->postId ."', '". $comment->name ."', '". $comment->email ."', '". $comment->body ."')";
    if (mysqli_query($conn, $sql)) {
        ++$db_counts["comments"];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        die();
    }
}

echo "Загружено ".$db_counts["posts"]." записей и ".$db_counts["comments"]." комментариев";


mysqli_close($conn);

?>