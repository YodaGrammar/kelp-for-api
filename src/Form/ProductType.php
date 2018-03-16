<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 16/03/2018
 * Time: 15:52
 */

namespace App\Form;


use App\DTO\ProductDTO;
use App\Entity\TypeProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        $builder
            ->add(
                'quantity',
                TextType::class,
                ['required' => false]
            )
            ->add(
                'type',
                EntityType::class, [
                'class'   => TypeProduct::class,
                'choice_label' => 'label',
            ],
                ['required' => false]
            )
            ->add(
                'label',
                TextType::class,
                ['required' => false]
            )
            ->add(
                'date',
                TextType::class,
                ['required' => false]
            )
            ->add(
                'save',
                SubmitType::class,
                ['attr' => ['class' => 'save']]
            );
        $options;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', ProductDTO::class);
    }
}