<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {

        $builder
            ->add('name', TextType::class, [
                'label' => 'Imię',
            ])
            ->add('mail', EmailType::class, [
                'label' => 'E-mail',
            ])
            ->add('pesel', TextType::class, [
                'attr' => [
                    'minlength' => 11,
                    'maxlength' => 11,
                    'size' => 11
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Treść wiadomości'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Wyślij wiadomość'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
