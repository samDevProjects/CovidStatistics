<?php

namespace App\Form;

use App\Entity\Hospital;
use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class HospitalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hospital_name', null, ['label' => false])
            ->add('cases_number', null, ['label' => false])
            ->add('deaths_number', null, ['label' => false])
            ->add('date_record', DateTimeType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => false,
            ])
            ->add('departement', EntityType::class, [
                'class' => Departement::class,
                'choice_label' => 'departmentName',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hospital::class,
        ]);
    }
}
