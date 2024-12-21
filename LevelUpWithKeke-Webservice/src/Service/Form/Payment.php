<?php


namespace App\Service\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class Payment extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', TextType::class, [
                'label' => 'Card Number',
            ])
            ->add('month', NumberType::class, [
                'label' => 'Month',
            ])
            ->add('year', NumberType::class, [
                'label' => 'Year',
            ])

            ->add('cvc', TextType::class, [
                'label' => 'CVC',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Pay',
            ]);
    }
}
