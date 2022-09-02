<?php

class Post
{
    private int $id;
    private int $userId;
    private string $title;
    private string $body;

    public function __construct(int $id, int $userId, string $title, string $body)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
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
     * Get the value of userId
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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