<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalarieRepository")
 */
class Salarie
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailPcs;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDernierTest;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nbNotesInferieur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $derniereNote;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmailPcs(): ?string
    {
        return $this->emailPcs;
    }

    public function setEmailPcs(string $emailPcs): self
    {
        $this->emailPcs = $emailPcs;

        return $this;
    }

    public function getDateDernierTest(): ?\DateTimeInterface
    {
        return $this->dateDernierTest;
    }

    public function setDateDernierTest(?\DateTimeInterface $dateDernierTest): self
    {
        $this->dateDernierTest = $dateDernierTest;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getNbNotesInferieur(): ?string
    {
        return $this->nbNotesInferieur;
    }

    public function setNbNotesInferieur(?string $nbNotesInferieur): self
    {
        $this->nbNotesInferieur = $nbNotesInferieur;

        return $this;
    }

    public function getDerniereNote(): ?string
    {
        return $this->derniereNote;
    }

    public function setDerniereNote(?string $derniereNote): self
    {
        $this->derniereNote = $derniereNote;

        return $this;
    }

    public function getMp(): ?string
    {
        return $this->mp;
    }

    public function setMp(string $mp): self
    {
        $this->mp = $mp;

        return $this;
    }
}
