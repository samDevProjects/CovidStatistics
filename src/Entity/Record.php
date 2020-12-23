<?php

namespace App\Entity;

use App\Repository\RecordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecordRepository::class)
 */
class Record
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Lab::class, inversedBy="records")
     */
    private $lab;

    /**
     * @ORM\ManyToOne(targetEntity=Hospital::class, inversedBy="records")
     */
    private $hospital;

    /**
     * @ORM\Column(type="integer")
     */
    private $week_record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLab(): ?Lab
    {
        return $this->lab;
    }

    public function setLab(?Lab $lab): self
    {
        $this->lab = $lab;

        return $this;
    }

    public function getHospital(): ?Hospital
    {
        return $this->hospital;
    }

    public function setHospital(?Hospital $hospital): self
    {
        $this->hospital = $hospital;

        return $this;
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
}
