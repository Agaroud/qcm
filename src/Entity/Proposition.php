<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropositionRepository")
 */
class Proposition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="text")
     */
    private $choix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Choice({"0", "1"})
     */
    private $vrai;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getChoix(): ?string
    {
        return $this->choix;
    }

    public function setChoix(string $choix): self
    {
        $this->choix = $choix;

        return $this;
    }

    public function getVrai(): ?int
    {
        return $this->vrai;
    }

    public function setVrai(int $vrai): self
    {
        $this->vrai = $vrai;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
    
}
