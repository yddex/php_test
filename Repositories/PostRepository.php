<?php

class PostRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * search post by id in database
     * 
     * @param int $id
     * @return Post 
     */
    public function getPostById(int $id) :Post
    {
        $statement = $this->db->prepare("SELECT * FROM posts WHERE id LIKE :id");
        $statement->execute(["id" => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result === false){
            throw new PDOException("Post not found. Id: $id");
        }

        return new Post($result["id"], $result["user_id"], $result["title"], $result["body"]);
    }
}