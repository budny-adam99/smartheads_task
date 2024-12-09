<?php

namespace App\Message;

class MessageEmail
{
    public function __construct(
        private readonly int $id,
    ) {

    }

    public function getId(): int
    {
        return $this->id;
    }

}