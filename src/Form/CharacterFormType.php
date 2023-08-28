<?php

namespace App\Form;

use App\Entity\Characters;
use App\Entity\Weakness;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CharacterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, ['attr' => ['placeholder'=>"indica nombre personaje", 'class'=>'nameInput'], 'label'=> "Nombre"])
            ->add('Planet')
            ->add('SuperPower')
            ->add('Description')
            ->add('BirthDate')
            ->add('weaknesses', EntityType::class, ['class'=> Weakness::class, 'multiple'=> true, 'choice_label'=>'name'])
            ->add ("enviar", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Characters::class,
        ]);
    }
}
