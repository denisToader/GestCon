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
            ->add('Nume')
            ->add('Prenume')
            //am adaugat un atribut maxlength care limiteaza lungimea campului la 10 caractere
            ->add('Nr_tel', TextType::class, [
                'attr' => [
                    'maxlength' => 10
                ]
            ])
            ->add('functie', ChoiceType::class,[
                'choices' => [
                    'Programator' => 'Programator',
                    'Tester' => 'Tester',
                    'HR' => 'HR'
                ]
            ])
            //am adaugat un buton pentru cu ajutorul caruia se face submit la formular
            ->add('Add', SubmitType::class, [
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
