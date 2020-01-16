<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

//entitatea pentru concedii
//creata folosind php bin/console make:entity

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConcediiRepository")
 */
class Concedii
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
    private $tip_concediu;

    /**
     * @ORM\Column(type="date")
     */
    private $data_de_la;

    /**
     * @ORM\Column(type="date")
     */
    private $data_pana_la;

    /**
     * @ORM\Column(type="integer")
     */
    private $nr_zile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Angajati")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_angajat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipConcediu(): ?string
    {
        return $this->tip_concediu;
    }

    public function setTipConcediu(string $tip_concediu): self
    {
        $this->tip_concediu = $tip_concediu;

        return $this;
    }

    public function getDataDeLa(): ?\DateTimeInterface
    {
        return $this->data_de_la;
    }

    public function setDataDeLa(\DateTimeInterface $data_de_la): self
    {
        $this->data_de_la = $data_de_la;

        return $this;
    }

    public function getDataPanaLa(): ?\DateTimeInterface
    {
        return $this->data_pana_la;
    }

    public function setDataPanaLa(\DateTimeInterface $data_pana_la): self
    {
        $this->data_pana_la = $data_pana_la;

        return $this;
    }

    public function getNrZile(): ?int
    {
        return $this->nr_zile;
    }

    public function setNrZile(int $nr_zile): self
    {
        $this->nr_zile = $nr_zile;

        return $this;
    }

    //functiile generate dupa crearea relatiei intre id_angajat din tabela concedii si id din tabela angajat
    public function getIdAngajat(): ?Angajati
    {
        return $this->id_angajat;
    }

    public function setIdAngajat(?Angajati $id_angajat): self
    {
        $this->id_angajat = $id_angajat;

        return $this;
    }
}
