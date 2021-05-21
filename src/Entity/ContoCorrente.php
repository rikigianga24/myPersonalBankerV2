<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * ContoCorrente
 *
 * @ApiResource(
 *      attributes={"security"="is_granted('ROLE_USER')"},
 *      collectionOperations={
 *         "get"={"security"="is_granted('ROLE_ADMIN')"}
 *      },
 *      itemOperations={
 *          "get"={"security"="is_granted('ROLE_ADMIN') or object.getCf() == user"},
 *      }
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
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="cf", referencedColumnName="cf")
     */
    private $cf;

    /**
     * @ORM\OneToMany(targetEntity=Transazione::class, mappedBy="ibanMittente")
     */
    private $transaziones;


    public function __construct()
    {
        $this->transaziones = new ArrayCollection();
    }

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

    /**
     * @return Collection|Transazione[]
     */
    public function getTransaziones(): Collection
    {
        return $this->transaziones;
    }

    public function addTransazione(Transazione $transazione): self
    {
        if (!$this->transaziones->contains($transazione)) {
            $this->transaziones[] = $transazione;
            $transazione->setIbanMittente($this);
        }

        return $this;
    }

    public function removeTransazione(Transazione $transazione): self
    {
        if ($this->transaziones->removeElement($transazione)) {
            // set the owning side to null (unless already changed)
            if ($transazione->getIbanMittente() === $this) {
                $transazione->setIbanMittente(null);
            }
        }

        return $this;
    }



}
