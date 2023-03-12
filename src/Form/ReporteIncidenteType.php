<?php

namespace App\Form;

use App\Entity\Incidente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReporteIncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tipo', ChoiceType::class,[
                'required'=>true,
                'multiple'=>false,
                'choices'=> $options["arrayIncidentes"],
                'choice_value'=>'id_tipo',
                'choice_label'=>'descripcion',
                'mapped'=>false,
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
            'arrayIncidentes'=>array()
        ]);
    }
}
