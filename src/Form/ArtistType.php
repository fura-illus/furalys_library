<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Artist name (mandatory)',
                'row_attr' => [
                    'class' => 'artist-name-input'
                ],
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description',
                'row_attr' => [
                    'class' => 'artist-description-input'
                ],
            ))
            ->add('avatarFile', FileType::class, [
            ])
            ->add('link')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
            'validation_groups' => 'avatar',
        ]);
    }
}
