<?php

namespace App\Entity;

use App\Repository\AppointmentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentsRepository::class)
 */
class Appointments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_a;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\OneToOne(targetEntity=Hopitaux::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $hopital;

    /**
     * @ORM\OneToOne(targetEntity=Medecins::class, inversedBy="mesRendezVous", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $docteur;

    /**
     * @ORM\OneToOne(targetEntity=Patients::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateA(): ?\DateTimeInterface
    {
        return $this->date_a;
    }

    public function setDateA(\DateTimeInterface $date_a): self
    {
        $this->date_a = $date_a;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getHopital(): ?Hopitaux
    {
        return $this->hopital;
    }

    public function setHopital(Hopitaux $hopital): self
    {
        $this->hopital = $hopital;

        return $this;
    }

    public function getDocteur(): ?Medecins
    {
        return $this->docteur;
    }

    public function setDocteur(Medecins $docteur): self
    {
        $this->docteur = $docteur;

        return $this;
    }

    public function getPatient(): ?Patients
    {
        return $this->patient;
    }

    public function setPatient(Patients $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
