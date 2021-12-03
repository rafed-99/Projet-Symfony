<?php

namespace App\Form;

use App\Entity\Tournoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class TournoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idtournoi')
            ->add('nomtournoi')
            ->add('nbrequipes')
            ->add('datedebuttournoi',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('datefintournoi',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('heurematchtournoi', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('nbrpoules');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' =>Tournoi::class,
        ]);
    }
}
