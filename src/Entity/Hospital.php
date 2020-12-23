<?php

namespace App\Entity;

use App\Repository\HospitalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HospitalRepository::class)
 */
class Hospital implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deaths_number;

    /**
     * @ORM\OneToMany(targetEntity=Record::class, mappedBy="hospital")
     */
    private $records;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hospital_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cases_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_record;

    /**
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="hospitals")
     */
    private $departement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cured_number;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $week_record;

    /**
     * @ORM\ManyToMany(targetEntity=Records::class, mappedBy="hospitals_rec")
     */
    private $hos_recs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dep_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $intcare;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $month_record;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city_name;

    public function __construct()
    {
        $this->records = new ArrayCollection();
        $this->hos_recs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeathsNumber(): ?int
    {
        return $this->deaths_number;
    }

    public function setDeathsNumber(int $deaths_number): self
    {
        $this->deaths_number = $deaths_number;

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
            $record->setHospital($this);
        }

        return $this;
    }

    public function removeRecord(Record $record): self
    {
        if ($this->records->removeElement($record)) {
            // set the owning side to null (unless already changed)
            if ($record->getHospital() === $this) {
                $record->setHospital(null);
            }
        }

        return $this;
    }

    public function getHospitalName(): ?string
    {
        return $this->hospital_name;
    }

    public function setHospitalName(string $hospital_name): self
    {
        $this->hospital_name = $hospital_name;

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

    public function getCuredNumber(): ?int
    {
        return $this->cured_number;
    }

    public function setCuredNumber(?int $cured_number): self
    {
        $this->cured_number = $cured_number;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

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
    public function getHosRecs(): Collection
    {
        return $this->hos_recs;
    }

    public function addHosRec(Records $hosRec): self
    {
        if (!$this->hos_recs->contains($hosRec)) {
            $this->hos_recs[] = $hosRec;
            $hosRec->addHospitalsRec($this);
        }

        return $this;
    }

    public function removeHosRec(Records $hosRec): self
    {
        if ($this->hos_recs->removeElement($hosRec)) {
            $hosRec->removeHospitalsRec($this);
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

    public function getIntcare(): ?int
    {
        return $this->intcare;
    }

    public function setIntcare(?int $intcare): self
    {
        $this->intcare = $intcare;

        return $this;
    }

    public function jsonSerialize(){
        return get_object_vars($this);
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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
    
}
