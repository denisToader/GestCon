<?php

namespace App\Form;

use App\Entity\Concedii;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

//formularul pentru adaugare sau editare concedii 
//creat folosind php bin/console make:form
class ConcediiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //campurile formularului create automat
        $builder
            /*->add('id_angajat', NumberType::class,[
                'attr' => [
                    'readonly' => true     //setez atributul readonly ca true, pentru a nu putea fi modificat de utilizator            
                ]
            ])*/
            ->add('tip_concediu', ChoiceType::class,[
                'choices' => [
                    'Odihna' => 'Odihna',
                    'Medical (disabled)' => 'Medical'
                ],
                'data' => 'Odihna',
                'choice_attr' => function($value) { //setez optiunea "medical" ca disabled deoarece functionalitatea pentru ea nu este creeata
                    if($value == 'Medical'){              // (zilele de concediu medical ar fi scazute din totalul de 25)
                        return ['disabled' => true];
                    } else {
                        return ['disabled' => false ];
                    }
                    
                }

            ])
            ->add('data_de_la', DateType::class, [
                'widget' => 'single_text' //modific aspectul campului pentru selectare "data de la"
            ])
            //la fel ca pentru campul de mai sus
            ->add('data_pana_la', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('nr_zile', NumberType::class,[
                'attr' => [
                    'readonly' => true     //setez atributul readonly ca true, pentru a nu putea fi modificat de utilizator, deoarece acest camp este calculat din cod            
                ]
            ])
            //am adaugat un buton pentru cu ajutorul caruia se face submit la formular
            ->add('Add', SubmitType::class, [ 
                'attr' => [
                    'class' => 'btn btn-primary float-right' //setez clasele butonului
                ] 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concedii::class,
        ]);
    }
}
