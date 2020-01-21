<?php
// src/EventListener/LocaleListener.php
namespace EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

//subscriu un eveniment pentru a-l putea executa de fiecare data cand se face un request
class LocaleListener implements EventSubscriberInterface
{
    //variabila cu care tine limba de afisaj implicita
    private $defaultLocale;

    //constructorul clasei care si seteaza valoarea implicita a limbii de afisaj, daca aceasta nu este specificata 
    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    //evenimentul care dorim sa fie ascultat
    public function onKernelRequest(RequestEvent $event)
    {
        //preluam request-ul intr-o variabila
        $request = $event->getRequest();
        //daca exista deja o sesiune, se iasa din functie
        if (!$request->hasPreviousSession()) {
            return;
        }

        // verific daca parametrul locale a fost setat din ruta  
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // daca nu a fost setat din ruta, atunci il setam din sesiunea curenta, deoarece el este salvat in sesiune, pentru a fi disponibil in mai multe pagini
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // trebuie sa fie inregistrata inainte de listener-ul Locale implicit , de aceea are valoarea 17 (cel implicit are val 16)
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}