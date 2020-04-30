<?php

namespace App;

class ChatroomEntryData
{
    public int $userId;
    public string $content;

    function __construct($userId, $content)
    {
        $this->userId = $userId;
        $this->content = $content;
    }
}