<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
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
    private $idQuestion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $idProposition;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdQuestion(): ?string
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(string $idQuestion): self
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

    public function getIdProposition(): ?string
    {
        return $this->idProposition;
    }

    public function setIdProposition(string $idProposition): self
    {
        $this->idProposition = $idProposition;

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
}
