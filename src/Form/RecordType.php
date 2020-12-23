<?php

namespace App\Form;

use App\Entity\Record;
use App\Entity\Lab;
use App\Entity\Hospital;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('week_record', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('lab', EntityType::class, [
                'class' => Lab::class,
                'required' => false,
                'choice_label' => 'lab_name',
                'label' => false,
            ])
            ->add('hospital', EntityType::class, [
                'class' => Hospital::class,
                'required' => false,
                'choice_label' => 'hospital_name',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Record::class,
        ]);
    }
}
