<?php

namespace App\Form;

use App\Entity\Materielles;
use App\Entity\Stade;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MateriellesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('ref')
            ->add('achat')
            ->add('etat', ChoiceType::class, [
                'choices'  => [
                    'Nouveau' => 'Nouveau',
                    'Bonne Occasion' => 'Bonne Occasion',
                    'Détruit' => 'Détruit',
                ],
            ])
            ->add('dispo', ChoiceType::class, [
                'choices'  => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
            ])
            ->add('prix')
            ->add('file')
            ->add('idStade',EntityType::class, array(
                'class' => Stade::class,
                'choice_label' => 'noms',
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materielles::class,
        ]);
    }
}
