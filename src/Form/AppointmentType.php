<?php

namespace App\Form;

use App\Entity\Appointment;
use App\Entity\Doctor;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AppointmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', EmailType::class)
            ->add('telephone', TelType::class,[
                'label' => 'Phone',
            ])
            ->add('date', DateType::class, array(
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                'html5' => true,
                'label' => 'Date (JJ/MM/AAAA)*',
            ))
            ->add('doctor', EntityType::class,[
                'class'=>Doctor::class,
                'choice_label'=>'name',
                'multiple'=>false,
                'expanded'=>false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class'=>Appointment::class,
        ]);
    }
}
