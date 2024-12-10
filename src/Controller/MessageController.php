<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Message\MessageEmail;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    #[Route(path: '/', name: 'message_form')]
    public function index(
        EntityManagerInterface $entityManager,
        MessageBusInterface $messageBus,
        Request $request
    ): Response {

        $form = $this->createForm(MessageType::class, ($entity = new Message()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($entity);
            $entityManager->flush();

            $messageBus->dispatch(new MessageEmail($entity->getId()));
            $this->addFlash('success', "Your message was sent successfully!");
        }

        return $this->render('message/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/panel/list', name: 'message_list')]
    public function list(
        MessageRepository $messageRepository,
    ): Response {

        return $this->render('message/list.html.twig', [
            'messages' => $messageRepository->findAll(),
        ]);
    }
}
