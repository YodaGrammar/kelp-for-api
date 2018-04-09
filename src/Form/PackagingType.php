<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 16/03/2018
 * Time: 15:52
 */

namespace App\Form;

use App\DTO\PackagingDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackagingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = null)
    {
        $builder
            ->add('label', TextType::class, [
                    'required' => false,
                    'label'    => 'packaging.form.field.label',
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
                'data_class'         => PackagingDTO::class,
                'translation_domain' => 'messages',
            ]);
    }
}
