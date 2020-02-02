<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert; 
//pour vérifier si new password différent de l'ancien password 


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email", message = "Cet email est déjà utilisé !")
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="L'email ne peut pas être vide")
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Il vous faut un mot de passe")
     * @Assert\Length(min="2", minMessage="Le prénom est trop petit",
     * max="255", maxMessage="Le prénom est trop long")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom ne peut pas être vide")
     * @Assert\Length(min="3", minMessage="Le prénom est trop petit",
     * max="255", maxMessage="Le prénom est trop long")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom ne peut pas être vide")
     * @Assert\Length(min="3", minMessage="Le nom est trop petit",
     * max="255", maxMessage="Le nom est trop long")
     */
    private $lastName;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type(type="DateTime")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="date")
     * @Assert\Type(type="DateTime")
     */
    private $createdDate;

    /** 
    * @ORM\Column(type="simple_array")
    * @Assert\NotBlank    
    */ 
    private $roles;

    public function __construct() {
        //$this->videoGames = new ArrayCollection();
        $this->roles = ['ROLE_USER'];
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getRoles() 
    {
        return $this->roles;
    }

    public function setRoles(array $roles): User 
    {
        $this->roles = $roles;   
        return $this;
    }

    public function getSalt()
    {
        return null; 
    }
    //pour login
    public function getUsername()
    {
        return $this->email; 
    }

    public function eraseCredentials()
    {
    }

}