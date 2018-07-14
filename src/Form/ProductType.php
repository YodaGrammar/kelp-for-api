<?php

namespace App\Form;

use App\Entity\Packaging;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Date;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'quantity',
                TextType::class,
                [
                    'required'    => false,
                    'label'       => 'product.form.field.quantity',
                    'constraints' => [new NotBlank()],
                ]
            )
            ->add(
                'packaging',
                EntityType::class,
                [
                    'class'        => Packaging::class,
                    'choice_label' => 'label',
                    'required'     => false,
                    'label'        => 'product.form.field.packaging',
                    'constraints' => [new NotBlank()],
                ]
            )
            ->add(
                'label',
                TextType::class,
                [
                    'required' => false,
                    'label'    => 'product.form.field.label',
                    'constraints' => [new NotBlank()],
                ]
            )
            ->add(
                'datePeremption',
                DateType::class,
                [
                    'widget'   => 'single_text',
                    'required' => false,
                    'label'    => 'product.form.field.date',
                    'constraints' => [new Date()],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => Product::class,
                'translation_domain' => 'messages',
            ]
        );
    }
}
