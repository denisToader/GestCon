<?php

namespace App\Controller;

use App\Entity\Angajati;
use App\Form\AngajatiType;

use App\Repository\AngajatiRepository;
use App\Repository\ConcediiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/*  Controller folosit pentru:
            * afisarea listei cu toti angajatii
            * afisarea detaliilor despre un angajat
            * afisarea concediilor totale ale unui angajat
            * stergerea unui angajat
            * editarea unui angajat
*/

/*  
    asignarea unei rute generale /view pentru intregul controller,
    iar sub-rutele specifice lui vor fi apelate sub forma "view.subruta"
*/

/**
 * @Route("/view", name="view.")
 */
class ViewController extends AbstractController
{ 
    //indexul controllerului care afiseaza toti angajatii

    /**
     * @Route("/", name="index")
     */
    public function view(AngajatiRepository $angajatiRepository){

        //preluarea tuturor angajatilor din repository-ul specific
        $angajati = $angajatiRepository->findAll();  

        //creare view pentru vizualizarea tuturor angajatilor
        return $this->render('view/index.html.twig', [
            //transmiterea variabilei angajati catre template, pentru a putea fi afisati
            'angajati' => $angajati
        ]);
    }

    //afisarea detaliilor unui angajat in urma selectarii acestuia din tabel (se transmite id-ul acestuia)

    /**
     * @Route("/show/{id}", name="show")
     */
    public function showDetails($id, AngajatiRepository $angajatiRepository, ConcediiRepository $concediiRepository){

        //cautare angajat cu id-ul primit in urma selectarii din tabel
        $angajat = $angajatiRepository->find($id);

        //cautam toate concediile pentru angajatul cu id = $id, dupa criteriul 'id_angajat'
        $concedii = $concediiRepository->findBy(array('id_angajat' => $id));

        //variabila cu numarul total de zile de concediu disponibile
        $zile_ramase = 25;
        foreach($concedii as $concediu) { 
            $zile_ramase -= $concediu->getNrZile(); //totalul zilelor ramase se scade din nr zilelor al fiecarui concediu
        }

        //creare view pentru show
        return $this->render('view/show.html.twig',[
            //transmiterea variabilelor catre template-ul de mai sus
            'angajat' => $angajat,
            'concedii' => $concedii,
            'zile_ramase' => $zile_ramase
        ]);
    }

    //stergerea unui angajat si a concediilor aferente acestuia (se transmite id-ul angajatului)

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Angajati $angajat, ConcediiRepository $concediiRepository){
        
        //gasirea concediilor angajatului curent
        $concedii = $concediiRepository->findBy(array('id_angajat' => $angajat->getId()));

        //se apeleaza managerul Doctrine
        $em = $this->getDoctrine()->getManager();
        //se sterge fiecare concediu gasit
        foreach($concedii as $concediu){
            $em->remove($concediu);
            $em->flush();
        }

        //se sterge angajatul
        $em->remove($angajat);
        $em->flush();

        //se face reload la pagina, prin redirectionarea catre aceeasi pagina
        return $this->redirectToRoute('view.index');
    }

    //editarea unui angajat (se transmite id-ul angajatului)
    
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, $id, AngajatiRepository $angajatiRepository)
    {
        //creare variabila de tip Angajati
        $angajat = new Angajati();
        //se cauta angajatul cu id-ul transmis
        $angajat = $angajatiRepository->find($id);
        
        //se creaza formularul de tipul AngajatiType si se transmite angajatul gasit
        //tot aici se populeaza si campurile cu valorile variabilei $angajat
        $form = $this->createForm(AngajatiType::class, $angajat);

        //se gestioneaza requestul
        $form->handleRequest($request);

        //daca se face submit la formular
        if($form->isSubmitted()){
            //se transmit valorile catre baza de date
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            //se face reload la pagina, prin redirectionarea catre aceeasi pagina
            return $this->redirectToRoute('view.index');
        }

        //se returneaza template-ul specific cu formularul creat trimis ca parametru
        return $this->render('view/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
