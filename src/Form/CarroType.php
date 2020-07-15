<?php

namespace App\Form;

use App\Entity\{Carro, Marca, Modelo};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CarroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proprietario',TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('placa',TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('modelo',EntityType::class, [
                'class' => Modelo::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carro::class,
        ]);
    }
}
