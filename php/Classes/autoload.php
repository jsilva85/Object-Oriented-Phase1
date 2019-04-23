<?php

class author {
    protected $authorId;
    protected $authorEmail;
    protected $authorUsername;


    public function_contruct(/**
 * @param mixed $authorEmail
 */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorUsername
     */
    public function setAuthorUsername($authorUsername)
    {
        $this->authorUsername = $authorUsername;
    }
}