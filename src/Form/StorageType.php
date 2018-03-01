<?php
namespace App\Form;

use App\DTO\StorageDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StorageType
 *
 * @package Kelp\AppBundle\Form
 */
class StorageType extends AbstractType
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
            );
        $options;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', StorageDTO::class);
    }
}
