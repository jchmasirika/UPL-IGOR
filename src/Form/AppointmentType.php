<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Doctor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('doctor', EntityType::class, [
                'class' => Doctor::class,
                'label' => 'Medecin',
                'choice_label' => function (Doctor $doctor): string {
                    return $doctor->getName() . ' - ' . $doctor->getSpeciality();
                }
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date du rendez-vous',
                'input_format' => 'Y-m-d H::s'
            ])
            ->add('description', null, [
                'label' => 'Commentaires'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
