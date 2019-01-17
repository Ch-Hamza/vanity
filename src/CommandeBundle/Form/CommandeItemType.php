<?php

namespace CommandeBundle\Form;

use CommandeBundle\Entity\CommandeItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size', ChoiceType::class, array(
                'choices' => array(
                    'XS' => 'XS',
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL'
                ),
                'placeholder' => 'Select',
            ))
            ->add('Color', ChoiceType::class, array(
                'choices' => array(
                    'White' => 'White',
                    'Black' => 'Black'
                ),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                ),
                'placeholder' => 'Select',
            ))
            ->add('quantity', IntegerType::class, array(
                'data' => '1',
                'attr' =>  array('min' => 1),
            ))
            ->add('save',  SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CommandeItem::class,
        ));
    }
}