<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('roles')
            ->add('password',  RepeatedType::class, array(
                                                            'type' => PasswordType::class,
                                                             'first_options'  => array('label' => 'Password'),
                                                             'second_options' => array('label' => 'Repeat Password')))
            ->add('pseudo', TextType::class)
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('civilite')
            ->add('date_enregistrement', DateType::class, [
                                                            'widget' => 'single_text',
                                                            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
