<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
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
    private $region_name;

    /**
     * @ORM\OneToMany(targetEntity=Departement::class, mappedBy="region")
     */
    private $departments;

    /**
     * @ORM\Column(type="integer")
     */
    private $region_code;

    public function __construct()
    {
        $this->departments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegionName(): ?string
    {
        return $this->region_name;
    }

    public function setRegionName(string $region_name): self
    {
        $this->region_name = $region_name;

        return $this;
    }

    /**
     * @return Collection|Departement[]
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Departement $department): self
    {
        if (!$this->departments->contains($department)) {
            $this->departments[] = $department;
            $department->setRegion($this);
        }

        return $this;
    }

    public function removeDepartment(Departement $department): self
    {
        if ($this->departments->removeElement($department)) {
            // set the owning side to null (unless already changed)
            if ($department->getRegion() === $this) {
                $department->setRegion(null);
            }
        }

        return $this;
    }

    public function getRegionCode(): ?int
    {
        return $this->region_code;
    }

    public function setRegionCode(int $region_code): self
    {
        $this->region_code = $region_code;

        return $this;
    }
}
