<?php

namespace App\MessageHandler;

use App\Message\MessageEmail;
use App\Service\EmailService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MessageEmailHandler
{
    public function __construct(
        private readonly EmailService $emailService
    ) {

    }

    public function __invoke(MessageEmail $message)
    {
        $this->emailService->sendEmail($message->getId());
    }

}