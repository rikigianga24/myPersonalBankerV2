<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utenti
 *
 * @ORM\Table(name="utenti", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_D7F3FFCBFAD56E62", columns={"iban"})})
 * @ORM\Entity(repositoryClass="App\Repository\UtentiRepository")
 */
class Utenti
{
    /**
     * @var string
     *
     * @ORM\Column(name="cf", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cf;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cognome", type="string", length=255, nullable=false)
     */
    private $cognome;

    /**
     * @var string
     *
     * @ORM\Column(name="cellulare", type="string", length=255, nullable=false)
     */
    private $cellulare;

    /**
     * @var string
     *
     * @ORM\Column(name="via", type="string", length=255, nullable=false)
     */
    private $via;

    /**
     * @var int
     *
     * @ORM\Column(name="civico", type="integer", nullable=false)
     */
    private $civico;

    /**
     * @var int
     *
     * @ORM\Column(name="cap", type="integer", nullable=false)
     */
    private $cap;

    /**
     * @var ContoCorrente
     *
     * @ORM\ManyToOne(targetEntity="ContoCorrente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="iban", referencedColumnName="iban")
     * })
     */
    private $iban;

    public function getCf(): ?string
    {
        return $this->cf;
    }

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


}
