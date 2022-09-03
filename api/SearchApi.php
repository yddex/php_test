<?php
require_once "../Models/Comment.php";
require_once "../Models/Post.php";
require_once "../Repositories/CommentRepository.php";
require_once "../Repositories/PostRepository.php";


$db = new PDO("sqlite:../db/database.sqlite");
$commentRepository = new CommentRepository($db);
$postRepository = new PostRepository($db);


try {

    if (isset($_GET["api"])&& $_GET["api"]="search" && isset($_GET["search"])) {
        
        //Извлекаем строку для поиска из GET запроса
        $searchSubstring = $_GET["search"];

        $response = [];
        //получаем массив комментов в результате поиска
        $foundComments = $commentRepository->searchCommentsByBody($searchSubstring);

        if(count($foundComments) === 0 ){
            $response["body"] = [];
        }

        //наполняем массив для представления
        foreach($foundComments as $comment){

            $postId = $comment->getPostId();
            if(!isset($response["body"][$postId])){

                $postTitle = $postRepository->getPostById($comment->getPostId())->getTitle();
                $response["body"][$postId] = [
                    "post_title" => $postTitle,
                    "comments" => []
                ];

            }
            $response["body"][$postId]["comments"][] = 
                [
                    "id" => $comment->getId(),
                    "name" => $comment->getName(),
                    "email" => $comment->getEmail(),
                    "body" => $comment->getBody()
                ];
        }

        $response["status"] = 200;
        echo json_encode($response);
    }


} catch (Exception $e) {
    $response["status"] = 500;
    $response["body"] = $e->getMessage();

    echo json_encode($response);
}



