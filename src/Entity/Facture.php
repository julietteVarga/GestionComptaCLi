<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
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
    private $numeroFacture;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $numeroChequeOuPaypal;

    /**
     * @ORM\ManyToOne(targetEntity=Consultant::class, inversedBy="factures")
     */
    private $consultant;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDePaiement::class, inversedBy="factures")
     */
    private $typeDePaiement;

    /**
     * @ORM\OneToMany(targetEntity=LigneFacture::class, mappedBy="facture",cascade={"persist", "remove" })
     */
    private $ligneFactures;

    /**
     */
    private $montantTotal;


    public function __construct()
    {
        $this->ligneFactures = new ArrayCollection();
    }

    public function __toString(){
        return $this->date->format('Y');
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    public function setNumeroFacture(string $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumeroChequeOuPaypal(): ?string
    {
        return $this->numeroChequeOuPaypal;
    }

    public function setNumeroChequeOuPaypal(?string $numeroChequeOuPaypal): self
    {
        $this->numeroChequeOuPaypal = $numeroChequeOuPaypal;

        return $this;
    }

    public function getConsultant(): ?Consultant
    {
        return $this->consultant;
    }

    public function setConsultant(?Consultant $consultant): self
    {
        $this->consultant = $consultant;

        return $this;
    }


    public function getTypeDePaiement(): ?TypeDePaiement
    {
        return $this->typeDePaiement;
    }

    public function setTypeDePaiement(?TypeDePaiement $typeDePaiement): self
    {
        $this->typeDePaiement = $typeDePaiement;

        return $this;
    }

    /**
     * @return Collection|LigneFacture[]
     */
    public function getLigneFactures(): Collection
    {
        return $this->ligneFactures;
    }

    /**
     * @param ArrayCollection $ligneFactures
     */
    public function setLigneFactures(ArrayCollection $ligneFactures): void
    {
        $this->ligneFactures = $ligneFactures;
    }


    public function addLigneFacture(LigneFacture $ligneFacture): self
    {
        if (!$this->ligneFactures->contains($ligneFacture)) {
            $this->ligneFactures[] = $ligneFacture;
            $ligneFacture->setFacture($this);
        }

        return $this;
    }

    public function removeLigneFacture(LigneFacture $ligneFacture): self
    {
        if ($this->ligneFactures->removeElement($ligneFacture)) {
            // set the owning side to null (unless already changed)
            if ($ligneFacture->getFacture() === $this) {
                $ligneFacture->setFacture(null);
            }
        }

        return $this;
    }

    /**
     * méthode en charge de retourner les calcules des lignes des facture
     * @return int|null
     */
    public function getMontantTotal(): ?int
    {
        $montantTotal = 0;
        foreach ($this->ligneFactures as $ligneFacture) {
            $montantTotal += $ligneFacture->getQuantite() * $ligneFacture->getMontant();

        }
        $this->montantTotal = $montantTotal;
        return $this->montantTotal;
    }


}
