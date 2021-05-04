<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * ContoCorrente
 *
 * @ApiResource(
 *      attributes={"security"="is_granted('ROLE_USER')"}
 * )
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="cf", referencedColumnName="cf")
     * })
     */
    private $cf;

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

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

    public function getStato(): ?bool
    {
        return $this->stato;
    }

    public function setStato(bool $stato): self
    {
        $this->stato = $stato;

        return $this;
    }

    public function getCf(): User
    {
        return $this->cf;
    }

    public function setCf(?User $cf): self
    {
        $this->cf = $cf;

        return $this;
    }


}
