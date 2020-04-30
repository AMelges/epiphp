<?php

namespace App;

class ChatroomData
{
    public int $roomId;
    public array $content = array();

    function __construct($roomId, $content)
    {
        $this->roomId = $roomId;
        $this->content = $content;
    }
}
