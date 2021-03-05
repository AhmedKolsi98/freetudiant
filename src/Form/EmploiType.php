<?php

namespace App\Form;

use App\Entity\Emploi;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emploiTitle')
            ->add('emploiDesc')
            ->add('emploiRenum')
            ->add('renumType')
            ->add('categorie', EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'categorieName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emploi::class,
        ]);
    }
}
