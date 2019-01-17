<?php

namespace CommandeBundle\Form;

use CommandeBundle\Entity\Commande;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FullCommande extends AbstractType
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
            ->add('items', CollectionType::class, array(
                'entry_type' => CommandeItemEditType::class,
                'entry_options' => array('label' => false),
            ))
            ->add('save',  SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Commande::class,
        ));
    }
}