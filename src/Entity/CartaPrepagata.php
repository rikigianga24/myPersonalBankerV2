<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CartaPrepagataRepository;

/**
 * @ApiResource(
 * attributes={"security"="is_granted('ROLE_USER')"},
 * itemOperations={
 * "get"={"security"="is_granted('ROLE_ADMIN') or object.getCf() == user"}
 * }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CartaPrepagataRepository")
 */
class CartaPrepagata
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     */
    private $saldo;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $cvv;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_scadenza;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_emissione;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipo;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="cf", referencedColumnName="cf")
     */
    private $cf;

    public function getCf(): User
    {
        return $this->cf;
    }

    public function setCf(?User $cf): self
    {
        $this->cf = $cf;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodice(): ?string
    {
        return $this->codice;
    }

    public function setCodice(string $codice): self
    {
        $this->codice = $codice;

        return $this;
    }

    public function getSaldo(): ?string
    {
        return $this->saldo;
    }

    public function setSaldo(string $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getDataScadenza(): ?\DateTimeInterface
    {
        return $this->data_scadenza;
    }

    public function setDataScadenza(\DateTimeInterface $data_scadenza): self
    {
        $this->data_scadenza = $data_scadenza;

        return $this;
    }

    public function getDataEmissione(): ?\DateTimeInterface
    {
        return $this->data_emissione;
    }

    public function setDataEmissione(\DateTimeInterface $data_emissione): self
    {
        $this->data_emissione = $data_emissione;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}
