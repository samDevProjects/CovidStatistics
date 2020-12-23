<?php

namespace App\Entity;

use App\Repository\RecordsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecordsRepository::class)
 */
class Records
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $week_record;

    /**
     * @ORM\ManyToMany(targetEntity=Hospital::class, inversedBy="hos_recs")
     */
    private $hospitals_rec;

    /**
     * @ORM\ManyToMany(targetEntity=Lab::class, inversedBy="lab_recs")
     */
    private $labs_rec;


    public function __construct()
    {
        $this->hospitals = new ArrayCollection();
        $this->recs_relation = new ArrayCollection();
        $this->hospitals_rec = new ArrayCollection();
        $this->labs_rec = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getWeekRecord(): ?int
    {
        return $this->week_record;
    }

    public function setWeekRecord(int $week_record): self
    {
        $this->week_record = $week_record;

        return $this;
    }

    /**
     * @return Collection|Hospital[]
     */
    public function getHospitalsRec(): Collection
    {
        return $this->hospitals_rec;
    }

    public function addHospitalsRec(Hospital $hospitalsRec): self
    {
        if (!$this->hospitals_rec->contains($hospitalsRec)) {
            $this->hospitals_rec[] = $hospitalsRec;
        }

        return $this;
    }

    public function removeHospitalsRec(Hospital $hospitalsRec): self
    {
        $this->hospitals_rec->removeElement($hospitalsRec);

        return $this;
    }

    /**
     * @return Collection|Lab[]
     */
    public function getLabsRec(): Collection
    {
        return $this->labs_rec;
    }

    public function addLabsRec(Lab $labsRec): self
    {
        if (!$this->labs_rec->contains($labsRec)) {
            $this->labs_rec[] = $labsRec;
        }

        return $this;
    }

    public function removeLabsRec(Lab $labsRec): self
    {
        $this->labs_rec->removeElement($labsRec);

        return $this;
    }

}
