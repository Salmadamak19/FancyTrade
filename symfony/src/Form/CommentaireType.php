<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Post;


class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomUser', null, [
            'data' => "Current_User", // set default value to current user's username
            'disabled' => true, // disable the field so it can't be changed
        ])            // ->add('imagec')
            ->add('descriptionc')
            // ->add('datec')
            // ->add('analyseCo')
            ->add('post',EntityType::class, [
                'class'=>Post::class,
                'choice_label'=>'id'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
