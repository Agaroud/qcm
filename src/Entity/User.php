<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository") 
 * @UniqueEntity(
 * fields= {"email"}, message ="Cet email est déjà utilisé")
 * @UniqueEntity(
 * fields= {"matricule"}, message ="Ce matricule est déjà utilisé")
 * @UniqueEntity(
 * fields= {"username"}, message ="Ce pseudo est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="6", minMessage="Votre mot de passe doit faire minimum 6 caractères")     
     */
    private $password;

    /**
     *  @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tapé le même mot de passe")
     */
    public $confirm_password;

    
    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reponse", mappedBy="user", orphanRemoval=true)
     */
    private $reponses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\QuestionQcm", mappedBy="userId")
     */
    private $questionQcms;

    

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
        $this->questionQcms = new ArrayCollection();
        
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }
    
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}

    public function getRoles() {
        return ['ROLE_USER'];
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setUser($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->contains($reponse)) {
            $this->reponses->removeElement($reponse);
            // set the owning side to null (unless already changed)
            if ($reponse->getUser() === $this) {
                $reponse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuestionQcm[]
     */
    public function getQuestionQcms(): Collection
    {
        return $this->questionQcms;
    }

    public function addQuestionQcm(QuestionQcm $questionQcm): self
    {
        if (!$this->questionQcms->contains($questionQcm)) {
            $this->questionQcms[] = $questionQcm;
            $questionQcm->addUserId($this);
        }

        return $this;
    }

    public function removeQuestionQcm(QuestionQcm $questionQcm): self
    {
        if ($this->questionQcms->contains($questionQcm)) {
            $this->questionQcms->removeElement($questionQcm);
            $questionQcm->removeUserId($this);
        }

        return $this;
    } 
       
        
}
