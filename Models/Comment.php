<?php

class Comment
{
    private int $id;
    private int $postId;
    private string $name;
    private string $email;
    private string $body;
    
    public function __construct(int $id, int $postId, string $name, string $email, string $body)
    {
        $this->id = $id;
        $this->postId = $postId;
        $this->name = $name;
        $this->email = $email;
        $this->body = $body;
    }
    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of postId
     *
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the value of body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}