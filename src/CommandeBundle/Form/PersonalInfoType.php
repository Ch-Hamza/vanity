<?php

namespace CommandeBundle\Form;

use CommandeBundle\Entity\PersonalInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerFirstName', TextType::class)
            ->add('customerLastName', TextType::class)
            ->add('customerEmail', TextType::class)
            ->add('customerPhone', NumberType::class)
            ->add('customerCity', TextType::class)
            ->add('customerAddress', TextType::class)
            ->add('postalCode', NumberType::class)
            ->add('save',  SubmitType::class, array(
                "attr" => array('class' => 'contact-btn')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PersonalInfo::class,
        ));
    }
}