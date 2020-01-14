<?php

namespace App\Controller;

use App\Entity\Angajati;
use App\Form\AngajatiType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

//Controller care gestioneaza adaugarea unui angajat
class AdaugareController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request)
    {
        //creare variabila de tipul Angajati
        $angajat = new Angajati();

        //se creaza formularul de tipul AngajatiType si se transmite variabila angajat 
        $form = $this->createForm(AngajatiType::class, $angajat);

        $form->handleRequest($request);

        //daca se face submit la formular
        if($form->isSubmitted()){
            //se transmit valorile catre baza de date
            $em = $this->getDoctrine()->getManager();
            $em->persist($angajat);
            $em->flush();

            return $this->redirectToRoute('view.index');
        }

        return $this->render('adaugare/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
