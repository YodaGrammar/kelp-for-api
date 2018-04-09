<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 16/03/2018
 * Time: 15:52
 */

namespace App\Form;

use App\DTO\ProductDTO;
use App\Entity\Packaging;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', TextType::class, [
                    'required' => false,
                    'label'    => 'product.form.field.quantity',
            ])
            ->add('packaging', EntityType::class, [
                    'class'        => Packaging::class,
                    'choice_label' => 'label',
                    'required' => false,
                    'label'    => 'product.form.field.packaging',
            ])
            ->add('label', TextType::class, [
                    'required' => false,
                    'label'    => 'product.form.field.label',
            ])
            ->add('date', DateType::class, [
                    'widget' => 'single_text',
                    'required' => false,
                    'label'    => 'product.form.field.date',
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class'         => ProductDTO::class,
                'translation_domain' => 'messages',
            ]);
    }
}
