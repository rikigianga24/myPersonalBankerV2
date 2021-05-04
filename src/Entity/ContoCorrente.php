<?php

namespace App\Entity;

use App\Entity\Utenti;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * ContoCorrente
 *
 * @ApiResource
 * @ORM\Table(name="conto_corrente", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_D443DF6CABD8EEF6", columns={"cf"})})
 * @ORM\Entity(repositoryClass="App\Repository\ContoCorrenteRepository")
 */
class ContoCorrente
{
    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iban;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $saldo;

    /**
     * @var bool
     *
     * @ORM\Column(name="stato", type="boolean", nullable=false)
     */
    private $stato;

    /**
     * @var Utenti
     *
     * @ORM\ManyToOne(targetEntity="Utenti")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cf", referencedColumnName="cf")
     * })
     */
    private $cf;

    public function getIban(): ?string
    {
        return $this->iban;
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

    public function getStato(): ?bool
    {
        return $this->stato;
    }

    public function setStato(bool $stato): self
    {
        $this->stato = $stato;

        return $this;
    }

    public function getCf(): Utenti
    {
        return $this->cf;
    }

    public function setCf(?Utenti $cf): self
    {
        $this->cf = $cf;

        return $this;
    }


}
