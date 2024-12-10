<?php

namespace App\Service;

use App\Repository\MessageRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailService
{
    public function __construct(
        private readonly string $senderEmail,
        private readonly string $receiverEmail,
        private readonly MessageRepository $messageRepository,
        private readonly MailerInterface $mailer,
    ) {}

    public function sendEmail(
        int $messageId
    ): void {

        $email = (new TemplatedEmail())
            ->from($this->senderEmail)
            ->to($this->receiverEmail)
            ->subject("Wiadomość z formularza kontaktowego")
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'message' => $this->messageRepository->find($messageId)
            ]);

        $this->mailer->send($email);

    }
}