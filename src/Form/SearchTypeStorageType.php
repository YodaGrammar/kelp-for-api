<?php
namespace Kelp\AppBundle\Form;

use Kelp\AppBundle\DTO\SearchTypeStorageDTO ;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SearchTypeStorageType
 *
 * @package Kelp\AppBundle\Form
 */
class SearchTypeStorageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        $builder
            ->add('text', TextType::class, ['required' => false])
            ->add('submit', SubmitType::class, ['label' => 'search']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data', SearchTypeStorageDTO::class);
    }
}
