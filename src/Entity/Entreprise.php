<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: PFE::class, orphanRemoval: true)]
    private $pfes;

    #[ORM\Column(type: 'string', length: 255)]
    private $designation;

    public function __construct()
    {
        $this->pfes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PFE>
     */
    public function getPfes(): Collection
    {
        return $this->pfes;
    }

    public function addPFE(PFE $designation): self
    {
        if (!$this->pfes->contains($designation)) {
            $this->pfes[] = $designation;
            $designation->setEntreprise($this);
        }

        return $this;
    }

    public function removePFE(PFE $designation): self
    {
        if ($this->pfes->removeElement($designation)) {
            // set the owning side to null (unless already changed)
            if ($designation->getEntreprise() === $this) {
                $designation->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }
}
