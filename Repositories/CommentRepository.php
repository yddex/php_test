<?php

require_once './Models/Comment.php';
class CommentRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    /**
     * Search substring in comments
     * @param string $substring 
     * @return array comments objects
     */
    public function searchCommentsByBody(string $substring) :array
    {
        $foundComments = [];
        $statement = $this->db->prepare("SELECT * FROM comments WHERE body LIKE :search;");
        $statement->execute(["search" => "%$substring%"]);

        while($comment = $statement->fetch(PDO::FETCH_ASSOC))
        {   
            $foundComments[] = new Comment(
                $comment["id"],
                $comment["post_id"],
                $comment["name"],
                $comment["email"],
                $comment["body"]
            );
        }

        return $foundComments;
    }
}