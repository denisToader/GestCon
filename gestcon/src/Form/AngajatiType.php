<?php

namespace App\Form;

use App\Entity\Angajati;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

//formularul pentru adaugare sau editare angajati 
//creat folosind php bin/console make:form
class AngajatiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //campurile formularului create automat
        $builder
            // traducerea se realzieaza automat in parametrul 'label' pe baza parametrului "_locale" setat
            ->add('Nume', TextType::class, [
                'label' => 'Last Name'
            ])
            ->add('Prenume', TextType::class, [
                'label' => 'First Name'
            ])
            //am adaugat un atribut maxlength care limiteaza lungimea campului la 10 caractere
            ->add('Nr_tel', TextType::class, [
                'label' => 'Phone Number',
                'attr' => [
                    'maxlength' => 10
                ]
            ])
            ->add('functie', ChoiceType::class,[
                'label' => 'Position',
                'choices' => [
                    'Programator' => 'Programator',
                    'Tester' => 'Tester',
                    'HR' => 'HR'
                ]
            ])
            //am adaugat un buton pentru cu ajutorul caruia se face submit la formular
            ->add('Add', SubmitType::class, [
                'label' => 'Add',
                'attr' => [
                    'class' => 'btn btn-primary float-right' // am adaugat un atribut clasa, pentru a face butonul sa fie pozitionat in dreapta (float-right)
                ] 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Angajati::class,
        ]);
    }
}
