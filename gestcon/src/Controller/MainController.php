<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    //ruta pentru home
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    // functie chemata pentru a schimba limba
    /**
     * @Route("/change_language/{language}", name="change_language")
     */
    public function change_language(Request $request, $language){

        //setez variabila "_locale" in functie de ce se alege ca limba de afisaj
        // este setata in sesiune (variabila "_locale"), pentru a fi disponibila in mai multe pagini
        $request->getSession()->set('_locale', $language);

        //preiau ultima ruta accesata (ex. http://127.0.0.1:8080/view)
        $referer = $request->server->get('HTTP_REFERER');

        //construiesc domeniul (ex. http://127.0.0.1:8080)
        $lastPath = $request->getScheme().'://'.$request->getHttpHost().$request->getBasePath();
        //inlocuiesc domeniul construit mai sus, cu un string gol penntru a ramane doar ruta necesara (ex. din http://127.0.0.1:8080/view ramane doar /view)
        $referer = str_replace($lastPath, "" , $referer);

        //redirectionez utilizatorul catre ruta de unde a apelat schimbarea de limba
        return $this->redirect($referer);

        //inainte redirectionam utilizatorul catre pagina home, ceea ce nu era user friendly, asa ca am folosit ideea de mai sus
        //return $this->redirectToRoute('home');
    }
}
