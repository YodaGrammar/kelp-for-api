<?php
namespace App\Form;

use App\DTO\TypeStorageDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TypeStorageType
 *
 * @package Kelp\AppBundle\Form
 */
class TypeStorageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        $builder
            ->add(
                'label',
                TextType::class,
                ['required' => false]
            )
            ->add(
                'class',
                TextType::class,
                ['required' => false]
            )
            ->add(
                'comment',
                TextareaType::class,
                ['required' => false]
            );
        $options;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', TypeStorageDTO::class);
    }
}
