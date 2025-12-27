<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AddToCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantity',
                'attr' => [
                    'min' => 1,
                    'max' => 99,
                    'class' => 'form-control',
                    'style' => 'max-width:100px'
                ]
            ])
            ->add('color', ChoiceType::class, [
                'label' => 'Select Color',
                'choices' => [
                    'Matte Black' => 'black',
                    'Pearl White' => 'white',
                    'Silver' => 'silver'
                ],
                'attr' => [
                    'class' => 'form-select',
                    'style' => 'max-width:200px'
                ]
            ])
            ->add('add', SubmitType::class, [
                'label' => 'Add to Cart',
                'attr' => [
                    'class' => 'btn btn-primary btn-lg'
                ]
            ]);
    }
}

