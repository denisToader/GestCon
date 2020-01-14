<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

//entitatea pentru angajati
//creata folosind php bin/console make:entity

/**
 * @ORM\Entity(repositoryClass="App\Repository\AngajatiRepository")
 */
class Angajati
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nr_tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $functie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNume(): ?string
    {
        return $this->Nume;
    }

    public function setNume(string $Nume): self
    {
        $this->Nume = $Nume;

        return $this;
    }

    public function getPrenume(): ?string
    {
        return $this->Prenume;
    }

    public function setPrenume(string $Prenume): self
    {
        $this->Prenume = $Prenume;

        return $this;
    }

    public function getNrTel(): ?string
    {
        return $this->Nr_tel;
    }

    public function setNrTel(string $Nr_tel): self
    {
        $this->Nr_tel = $Nr_tel;

        return $this;
    }

    public function getFunctie(): ?string
    {
        return $this->functie;
    }

    public function setFunctie(string $functie): self
    {
        $this->functie = $functie;

        return $this;
    }
}
