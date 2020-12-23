<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 */
class Departement implements \JsonSerializable
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
    private $department_name;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="departments")
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departement_number;

    /**
     * @ORM\OneToMany(targetEntity=Lab::class, mappedBy="departement")
     */
    private $labs;

    /**
     * @ORM\OneToMany(targetEntity=Hospital::class, mappedBy="departement")
     */
    private $hospitals;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
        $this->labs = new ArrayCollection();
        $this->hospitals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartmentName(): ?string
    {
        return $this->department_name;
    }

    public function setDepartmentName(string $department_name): self
    {
        $this->department_name = $department_name;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getDepartementNumber(): ?string
    {
        return $this->departement_number;
    }

    public function setDepartementNumber(string $departement_number): self
    {
        $this->departement_number = $departement_number;

        return $this;
    }

    /**
     * @return Collection|Lab[]
     */
    public function getLabs(): Collection
    {
        return $this->labs;
    }

    public function addLab(Lab $lab): self
    {
        if (!$this->labs->contains($lab)) {
            $this->labs[] = $lab;
            $lab->setDepartement($this);
        }

        return $this;
    }

    public function removeLab(Lab $lab): self
    {
        if ($this->labs->removeElement($lab)) {
            // set the owning side to null (unless already changed)
            if ($lab->getDepartement() === $this) {
                $lab->setDepartement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hospital[]
     */
    public function getHospitals(): Collection
    {
        return $this->hospitals;
    }

    public function addHospital(Hospital $hospital): self
    {
        if (!$this->hospitals->contains($hospital)) {
            $this->hospitals[] = $hospital;
            $hospital->setDepartement($this);
        }

        return $this;
    }

    public function removeHospital(Hospital $hospital): self
    {
        if ($this->hospitals->removeElement($hospital)) {
            // set the owning side to null (unless already changed)
            if ($hospital->getDepartement() === $this) {
                $hospital->setDepartement(null);
            }
        }

        return $this;
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
