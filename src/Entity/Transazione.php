<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TransazioneRepository;

/**
 * Transazione
 * 
 * @ApiResource(
 *      attributes={"security"="is_granted('ROLE_USER')"},
 *      collectionOperations={
 *         "get"={"security"="is_granted('ROLE_USER')"},
 *         "post"={
 *              "method"="POST",
 *              "controller"="TransazioneController::class"
 *              }
 *          },
 *      itemOperations={
 *          "get"={
 *          "controller"="TransazioneController::class",
 *          "method"="GET"
 *          }  
 *      }
 * )
 * @ORM\Table(name="transazione")
 * @ORM\Entity(repositoryClass="App\Repository\TransazioneRepository")
 */
class Transazione
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="importo", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $importo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * @var string
     * @ORM\Column(name="iban_destinatario", type="string", length=255, nullable=false)
     */
    private $ibanDestinatario;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", columnDefinition="enum('Bonifico SEPA', 'Giroconto' ,'Deposito','Prelievo','Pagamento On-Line','Assegno bancario')", nullable=false)
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity=ContoCorrente::class, inversedBy="transaziones")
     * @ORM\JoinColumn(name="iban", referencedColumnName="iban")
     */
    private $ibanMittente;

    /**
     * @ORM\Column(name="movimento", type="string", columnDefinition="enum('Entrata', 'Uscita')")
     */
    private $movimento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImporto(): ?string
    {
        return $this->importo;
    }

    public function setImporto(string $importo): self
    {
        $this->importo = $importo;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

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

    public function getIbanMittente(): ?ContoCorrente
    {
        return $this->ibanMittente;
    }

    public function setIbanMittente(?ContoCorrente $ibanMittente): self
    {
        $this->ibanMittente = $ibanMittente;

        return $this;
    }

    public function getIbanDestinatario(): ?string
    {
        return $this->ibanDestinatario;
    }

    public function setIbanDestinatario(string $ibanDestinatario): self
    {
        $this->ibanDestinatario = $ibanDestinatario;

        return $this;
    }

    public function getMovimento(): ?string
    {
        return $this->movimento;
    }

    public function setMovimento(string $movimento): self
    {
        $this->movimento = $movimento;

        return $this;
    }

}
