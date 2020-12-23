<?php

namespace App\Entity;

use App\Repository\LabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabRepository::class)
 */
class Lab
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lab_name;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cases_number;

    /**
     * @ORM\OneToMany(targetEntity=Record::class, mappedBy="lab")
     */
    private $records;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_record;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="labs")
     */
    private $departement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $week_record;

    /**
     * @ORM\ManyToMany(targetEntity=Records::class, mappedBy="labs_rec")
     */
    private $lab_recs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dep_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tested_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $negatif_number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $month_record;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    
    public function __construct()
    {
        $this->records = new ArrayCollection();
        $this->lab_recs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabName(): ?string
    {
        return $this->lab_name;
    }

    public function setLabName(string $lab_name): self
    {
        $this->lab_name = $lab_name;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getCasesNumber(): ?int
    {
        return $this->cases_number;
    }

    public function setCasesNumber(int $cases_number): self
    {
        $this->cases_number = $cases_number;

        return $this;
    }

    /**
     * @return Collection|Record[]
     */
    public function getRecords(): Collection
    {
        return $this->records;
    }

    public function addRecord(Record $record): self
    {
        if (!$this->records->contains($record)) {
            $this->records[] = $record;
            $record->setLab($this);
        }

        return $this;
    }

    public function removeRecord(Record $record): self
    {
        if ($this->records->removeElement($record)) {
            // set the owning side to null (unless already changed)
            if ($record->getLab() === $this) {
                $record->setLab(null);
            }
        }

        return $this;
    }

    public function getDateRecord(): ?\DateTimeInterface
    {
        return $this->date_record;
    }

    public function setDateRecord(\DateTimeInterface $date_record): self
    {
        $this->date_record = $date_record;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getWeekRecord(): ?int
    {
        return $this->week_record;
    }

    public function setWeekRecord(?int $week_record): self
    {
        $this->week_record = $week_record;

        return $this;
    }

    /**
     * @return Collection|Records[]
     */
    public function getLabRecs(): Collection
    {
        return $this->lab_recs;
    }

    public function addLabRec(Records $labRec): self
    {
        if (!$this->lab_recs->contains($labRec)) {
            $this->lab_recs[] = $labRec;
            $labRec->addLabsRec($this);
        }

        return $this;
    }

    public function removeLabRec(Records $labRec): self
    {
        if ($this->lab_recs->removeElement($labRec)) {
            $labRec->removeLabsRec($this);
        }

        return $this;
    }

    public function getDepName(): ?string
    {
        return $this->dep_name;
    }

    public function setDepName(?string $dep_name): self
    {
        $this->dep_name = $dep_name;

        return $this;
    }

    public function getTestedNumber(): ?int
    {
        return $this->tested_number;
    }

    public function setTestedNumber(?int $tested_number): self
    {
        $this->tested_number = $tested_number;

        return $this;
    }

    public function getNegatifNumber(): ?int
    {
        return $this->negatif_number;
    }

    public function setNegatifNumber(?int $negatif_number): self
    {
        $this->negatif_number = $negatif_number;

        return $this;
    }

    public function getMonthRecord(): ?int
    {
        return $this->month_record;
    }

    public function setMonthRecord(?int $month_record): self
    {
        $this->month_record = $month_record;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->city_name;
    }

    public function setCityName(?string $city_name): self
    {
        $this->city_name = $city_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
