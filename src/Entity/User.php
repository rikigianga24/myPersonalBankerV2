<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ApiResource(
 * itemOperations={"get"},
 * attributes={
 *      "normalization_context"={"groups"={"read"}},
 *      "denormalization_context"={"groups"={"write"}}
 * })
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{

    /**
     * @ORM\Column(name="cf", type="string", length=255, nullable=false)
     * @ORM\Id
     * @Groups({"read"})
     */
    private $cf;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

     /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     * @Groups({"read", "write"})
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cognome", type="string", length=255, nullable=false)
     * @Groups({"read"})
     */
    private $cognome;

    /**
     * @var string
     *
     * @ORM\Column(name="cellulare", type="string", length=255, nullable=false)
     * @Groups({"read"})
     */
    private $cellulare;

    /**
     * @var string
     *
     * @ORM\Column(name="via", type="string", length=255, nullable=false)
     * @Groups({"read"})
     */
    private $via;

    /**
     * @var int
     *
     * @ORM\Column(name="civico", type="integer", nullable=false)
     * @Groups({"read"})
     */
    private $civico;

    /**
     * @var int
     *
     * @ORM\Column(name="cap", type="integer", nullable=false)
     * @Groups({"read"})
     */
    private $cap;

    /**
     * @var ContoCorrente
     *
     * @ORM\OneToOne(targetEntity="App\Entity\ContoCorrente")
     * @Groups({"read"})
     * @ORM\JoinColumn(name="iban", referencedColumnName="iban")
     */
    private $iban;


    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getCognome(): ?string
    {
        return $this->cognome;
    }

    public function setCognome(string $cognome): self
    {
        $this->cognome = $cognome;

        return $this;
    }

    public function getCellulare(): ?string
    {
        return $this->cellulare;
    }

    public function setCellulare(string $cellulare): self
    {
        $this->cellulare = $cellulare;

        return $this;
    }

    public function getVia(): ?string
    {
        return $this->via;
    }

    public function setVia(string $via): self
    {
        $this->via = $via;

        return $this;
    }

    public function getCivico(): ?int
    {
        return $this->civico;
    }

    public function setCivico(int $civico): self
    {
        $this->civico = $civico;

        return $this;
    }

    public function getCap(): ?int
    {
        return $this->cap;
    }

    public function setCap(int $cap): self
    {
        $this->cap = $cap;

        return $this;
    }

    public function getIban(): ?ContoCorrente
    {
        return $this->iban;
    }

    public function setIban(?ContoCorrente $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getCf(): ?string
    {
        return $this->cf;
    }

    public function setCf(string $cf): self
    {
        $this->cf = $cf;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->cf;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
