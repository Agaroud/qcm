<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QcmTabRepository")
 */
class QcmTab
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="qcmTabs")
     */
    private $idUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $reponses = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $questions = [];

    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getReponses(): ?array
    {
        return $this->reponses;
    }

    public function setReponses(?array $reponses): self
    {
        $this->reponses = $reponses;

        return $this;
    }

    public function getQuestions(): ?array
    {
        return $this->questions;
    }

    public function setQuestions(?array $questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    

}
