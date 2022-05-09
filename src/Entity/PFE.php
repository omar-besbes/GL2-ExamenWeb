<?php

namespace App\Entity;

use App\Repository\PFERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PFERepository::class)]
class PFE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $titre;

    #[ORM\Column(type: 'string', length: 100)]
    private $etudiant;

    #[ORM\ManyToOne(targetEntity: Entreprise::class, inversedBy: 'pfes')]
    #[ORM\JoinColumn(nullable: false)]
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getEtudiant(): ?string
    {
        return $this->etudiant;
    }

    public function setEtudiant(string $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

	public function __toString(): string
	{
		return "Sujet " . $this->getTitre() . " réalisé par " . $this->getEtudiant() . " au sein de l'entreprise " . $this->getEntreprise();
	}

}
