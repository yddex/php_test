<?php

$db = require_once 'db.php';
$posts_url = "https://jsonplaceholder.typicode.com/posts";
$comments_url = "https://jsonplaceholder.typicode.com/comments";


$posts_data = file_get_contents($posts_url);
$comments_data = file_get_contents($comments_url);

$posts = json_decode($posts_data);
$comments = json_decode($comments_data);

/**
 * Сохранение постов в базу данных  
 * @param PDO $db database
 * @param array $posts objects posts to save in database
 */
function savePostsInDB(PDO $db, array $posts) :void
{
    $statement = $db->prepare("INSERT INTO posts (id, user_id, title, body) VALUES
        (:id, :user_id, :title, :body);");

    foreach($posts as $post){
        $statement->execute([
            "id" => $post->id,
            "user_id" => $post->userId,
            "title" => $post->title,
            "body" => $post->body
        ]);
    }
}

/**
 * Сохранение комментариев в базу данных  
 * @param PDO $db database
 * @param array $comments objects comments to save in database
 */
function saveCommentsInDB(PDO $db, array $comments) :void
{
    $statement = $db->prepare("INSERT INTO comments (id, post_id, name, email, body) VALUES
        (:id, :post_id, :name, :email, :body);");

    foreach($comments as $comment){
        $statement->execute([
            "id" => $comment->id,
            "post_id" => $comment->postId,
            "name" => $comment->name,
            "email" => $comment->email,
            "body" => $comment->body
        ]);
    }
}
try{

savePostsInDB($db, $posts);
saveCommentsInDB($db, $comments);

echo "Загружено " .  count($posts) . " записей и " .  count($comments) . " комментариев";
}catch(PDOException $e){

    // echo $e->getMessage();
    echo PHP_EOL . "Что-то пошло не так. Возможно, в базу данных уже были загружены текущие данные." . PHP_EOL;
}


