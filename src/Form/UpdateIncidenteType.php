<?php

namespace App\Form;

use App\Entity\Incidente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateIncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('solucion', TextType::class,[
                'attr' => [
                    'class'=>'form-control',
                    'required'=>true                    
                ]
            ])
            ->add('estadoIncidente', ChoiceType::class, [
                'choices'  => [
                    'Atendiendo' => 'Atendiendo',
                    'Finalizado' => 'Finalizado',
                ],
                'attr' => [
                    'class'=>'form-control',
                    'required'=>true                    
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Incidente::class,
        ]);
    }
}
