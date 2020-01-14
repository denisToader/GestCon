<?php

namespace App\Controller;

use App\Entity\Angajati;
use App\Entity\Concedii;
use App\Form\ConcediiType;
use App\Repository\AngajatiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcediiRepository;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/*  Controller folosit pentru:
            * adaugarea unui concediu
            * stergerea unui concediu
            * editarea unui concediu
*/

/*  
    asignarea unei rute generale /concedii pentru intregul controller,
    iar sub-rutele specifice lui vor fi apelate sub forma "concedii.subruta"
*/

/**
 * @Route("/concedii", name="concedii.")
 */
class ConcediiController extends AbstractController
{
    //stergerea unui concediu cu id-ul trimis
    
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Concedii $concediu){

        //stergerea concediului
        $em = $this->getDoctrine()->getManager();
        $em->remove($concediu);
        $em->flush();

        $id_angajat = $concediu->getIdAngajat();
        
        /* redirectionarea catre pagina anterioara (cu detaliile despre angajatul caruia se sterge concediul)
            si se transmite id-ul angajatului pentru a fi incarcata pagina corecta
            (pagina de la care a pornit adaugarea) 
        */
        return $this->redirect($this->generateUrl('view.show',[
            'id' => $id_angajat
        ]));

    }

    //adaugarea unui concediu
    
    /**
     * @Route("/add/{id}", name="add")
     */
    public function add(Request $request, $id, AngajatiRepository $angajatiRepository){

        /* se cauta angajatul pentru care se face inserarea, 
            pentru a fi afisat numele si prenumele acestuia deasupra formularului
        */
        $angajat = new Angajati();
        $angajat = $angajatiRepository->find($id);

        //se creaza variabila de tipul Concedii
        $concediu = new Concedii();
        /* se seteaza id-ul angajatului pentru care se adauga concediul
            (campul "id angajat" este de tipul read only si se face inserarea lui din cod,
            pentru ca utilizatorul sa nu fie nevoit sa retina un id)
        */
        $concediu->setIdAngajat($id);

        //se seteaza campurile "data de la" si "data pana la" cu data curenta (de azi)
        $concediu->setDataDeLa(new \DateTime());
        $concediu->setDataPanaLa(new \DateTime());

        //se seteaza campul "nr zile" cu valoarea 1, pentru ca ambele date de mai sus contin ziua de azi
        //deci doar o zi de concediu este calculata
        $concediu->setNrZile(1);

        //se creaza formularul
        $form = $this->createForm(ConcediiType::class, $concediu);

        $form->handleRequest($request);

        //daca se face submit se adauga in baza de date concediul
        if($form->isSubmitted()){            

            $em = $this->getDoctrine()->getManager();
            $em->persist($concediu);
            $em->flush();

            //se redirectioneaza utilizatorul la pagina cu detalii ale angajatului corespunzator
            return $this->redirect($this->generateUrl('view.show',[
                'id' => $id
            ]));
        } 
        
        /* se returneaza template-ul dorit cu formularul trimis ca variabila,
            variabila angajat pentru a putea fi afisat numele si prenumele acestuia deasupra formularului
            si actiunea

            actiunea poate fi adaugare sau editare (in acest caz este adaugare), 
            deoarece formularul este folosit de ambele functii,
            aceasta actiune seteaza deasupra formularului textul corespunzator
            ex. Editare concediu pentru angajatul X
                Adaugare concediu pentru angajatul X
        */
        return $this->render('concedii/index.html.twig', [
            'form' => $form->createView(),
            'angajat' => $angajat,
            'actiune' => 'Adaugare '
        ]);
    }

    //editare concediu cu id-ul trimis

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, $id, ConcediiRepository $concediiRepository, AngajatiRepository $angajatiRepository){        
        //creare variabila de tip Concediu
        $concediu = new Concedii();
        //se cauta concediul cu id-ul trimis, in repository-ul de concedii
        $concediu = $concediiRepository->find($id);
        
        //se creaza formularul corespunzator
        $form = $this->createForm(ConcediiType::class, $concediu);

        $form->handleRequest($request);

        /*  se cauta id-ul angajatului, pentru ca dupa trimiterea acestuia
            utilizatorul sa poata fi redirectionat la pagina anterioara
            (pagina de unde s-a plecat - cu detalii despre utilizator)
        */
        $id_angajat = $concediu->getIdAngajat();
        $angajat = new Angajati();
        $angajat = $angajatiRepository->find($id_angajat);

        //cand se face submit pe formular, se salveaza in baza de date
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            //redirectionarea catre pagina anterioara (de unde s-a apelat editarea, explicata mai sus)
            return $this->redirect($this->generateUrl('view.show',[
                'id' => $id_angajat //trimiterea id-ului angajat pt a putea fi afisata pagina corespunzatoare
            ]));
        }

        /* afisarea paginii cu formularul, cu numele si prenumele angjatului deasupra acestuia
            si actiunea (chestiuni explicate mai sus in ruta pt adaugare)
        */
        return $this->render('concedii/index.html.twig', [
            'form' => $form->createView(),
            'angajat' => $angajat,
            'actiune' => 'Editare '
        ]);

    }
}
