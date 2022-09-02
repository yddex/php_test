<?php

$db = require_once "./db.php";

$commentRepository = new CommentRepository($db);
$postRepository = new PostRepository($db);

$response = [];
$error = null;
$notfound = false;
try {

    if (isset($_GET["search"])) {
        //Извлекаем строку для поиска из GET запроса
        $searchSubstring = $_GET["search"];
        if (strlen($searchSubstring) < 3) {
            throw new Exception("Поисковой запрос должен быть не менее 3 символов.");
        }

        //получаем массив комментов в результате поиска
        $foundComments = $commentRepository->searchCommentsByBody($searchSubstring);

        //наполняем массив для представления
        foreach($foundComments as $comment){

            $postId = $comment->getPostId();
            if(!isset($response[$postId])){

                $postTitle = $postRepository->getPostById($comment->getPostId())->getTitle();
                $response[$postId] = [
                    "post_title" => $postTitle,
                    "comments" => []
                ];

            }
            $response[$postId]["comments"][] = 
                [
                    "id" => $comment->getId(),
                    "name" => $comment->getName(),
                    "email" => $comment->getEmail(),
                    "body" => $comment->getBody()
                ];
        }

        if(count($response) === 0 ){
            $notfound = true;
        }
    }
}catch(PDOException $e){
    $error = "Проблема с подключением к бд";

} catch (Exception $e) {
    $error = $e->getMessage();
}

require_once "./View/searchform.php";
