<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $nameCategory;

    /**
     * @ORM\OneToMany(targetEntity=Artical::class, mappedBy="category")
     */
    private $catArtical;

    public function __construct()
    {
        $this->catArtical = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    /**
     * @return Collection<int, Artical>
     */
    public function getCatArtical(): Collection
    {
        return $this->catArtical;
    }

    public function addCatArtical(Artical $catArtical): self
    {
        if (!$this->catArtical->contains($catArtical)) {
            $this->catArtical[] = $catArtical;
            $catArtical->setCategory($this);
        }

        return $this;
    }

    public function removeCatArtical(Artical $catArtical): self
    {
        if ($this->catArtical->removeElement($catArtical)) {
            // set the owning side to null (unless already changed)
            if ($catArtical->getCategory() === $this) {
                $catArtical->setCategory(null);
            }
        }

        return $this;
    }
}
