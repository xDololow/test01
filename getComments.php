<?php
include('dbData.php');

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
}

$sql = "SELECT id, title FROM testdb.posts WHERE id IN (SELECT DISTINCT postId FROM testdb.comments WHERE `body` LIKE '%".$_POST["search"]."%');"; //$_POST["search"]

$posts = mysqli_query($conn, $sql);

if (mysqli_num_rows($posts) > 0) {

    while($post = mysqli_fetch_assoc($posts)) {
        echo "Заголовок: " . $post['title'] . "<br>";
        
        $sql = "SELECT `body` FROM testdb.comments WHERE `postId` LIKE " . $post["id"]. " AND `body` LIKE '%".$_POST["search"]."%';";
        
        $comments = mysqli_query($conn, $sql);

        echo "<ol>";
        while($comment = mysqli_fetch_assoc($comments)) {
            echo "<li>".$comment['body']."</li>";
        }
        echo "</ol>";

    }

} else {
    echo "0 результатов";
}

?>