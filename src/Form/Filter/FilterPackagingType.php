<?php

namespace App\Form\Filter;

use App\DTO\Filter\PackagingDTOFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FilterPackagingType
 * @package App\Form\Filter
 */
class FilterPackagingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        $builder->add('text', TextType::class, [
            'required' => false,
            'attr' => ['class'    => 'form-control-sm mr-2'],
            'label_attr' => ['class'=> 'mr-2'],
            'label'    => 'packaging.form_filter.field.label',
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data', 'messages');
    }
}
