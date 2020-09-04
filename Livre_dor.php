<?php

class Livre_dor
{
    private $message;
    private $email;
    private $name;
    private $datePost;

    public function __construct(string $message, string $email, string $name, string $datePost = null)
    {
        $this->message = $message;
        $this->email = $email;
        $this->name = $name;
        $this->datePost = $datePost;
    }

    public function getMessage()
    {
        return $this->message;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getTime()
    {
        $datePost = DateTime::createFromFormat('Y-m-d H:i:s', $this->datePost);
        return $datePost->format('Y-M-d à H:i');
    }
}
