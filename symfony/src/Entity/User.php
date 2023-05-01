<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "user")]
#[UniqueEntity(fields: ["email"], message: "This email address is already in use.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_user", type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 180, unique: true)]
    #[Assert\NotBlank(message: "email field is empty")]
    #[Assert\Email(message: "The email {{ value }} is not a valid email.")]
    private string $email;

    #[ORM\Column(type: "string")]
    private string $roles;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank(message: "password field is empty")]
    private string $password;

    #[ORM\Column(name: "nom", type: "string", length: 20, nullable: false)]
    #[Assert\NotBlank(message: "name field is empty")]
    private string $nom;

    #[ORM\Column(name: "prenom", type: "string", length: 20, nullable: false)]
    #[Assert\NotBlank(message: "prenom field is empty")]
    private string $prenom;

    #[ORM\Column(name: "date_naiss", type: "date", nullable: false)]
    #[Assert\NotBlank(message: "date field is empty")]
    private DateTime $dateNaiss;

    #[ORM\Column(name: "enabled", type: "boolean", options: ["default" => "1"])]
    private bool $enabled;

    #[ORM\Column(name: "token", type: "string", nullable: true)]
    private ?string $token;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return [$this->roles];
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return DateTime
     */
    public function getDateNaiss(): DateTime
    {
        return $this->dateNaiss;
    }

    /**
     * @param DateTime $dateNaiss
     */
    public function setDateNaiss(DateTime $dateNaiss): void
    {
        $this->dateNaiss = $dateNaiss;
    }


    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }


}
