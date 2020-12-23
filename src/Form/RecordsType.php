<?php

namespace App\Form;

use App\Entity\Records;
use App\Entity\Lab;
use App\Entity\Hospital;
//use CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RecordsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('week_record', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('labs_rec', EntityType::class, [
                'class' => Lab::class,
                'required' => false,
                'choice_label' => 'dep_name',
                'label' => false,
                'multiple' => true,
            ])

            ->add('hospitals_rec', EntityType::class, [
                'class' => Hospital::class,
                'required' => false,
                'choice_label' => 'dep_name',
                'label' => false,
                'multiple' => true,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Records::class,
        ]);
    }
}
