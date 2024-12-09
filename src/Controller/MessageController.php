<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    #[Route('/')]
    public function index(
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {

        $form = $this->createForm(MessageType::class, ($entity = new Message()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($entity);
            $entityManager->flush();
            $this->addFlash('success', "Your message was sent successfully!");
        }

        return $this->render('message/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}