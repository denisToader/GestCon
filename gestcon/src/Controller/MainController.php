<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
