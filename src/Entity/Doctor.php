<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctorRepository::class)]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\ManyToOne(inversedBy: 'doctor')]
    private ?Specialities $specialities = null;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: Appointment::class)]
    private Collection $doctor;

    public function __construct()
    {
        $this->doctor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getSpecialities(): ?Specialities
    {
        return $this->specialities;
    }

    public function setSpecialities(?Specialities $specialities): self
    {
        $this->specialities = $specialities;

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getDoctor(): Collection
    {
        return $this->doctor;
    }

    public function addDoctor(Appointment $doctor): self
    {
        if (!$this->doctor->contains($doctor)) {
            $this->doctor->add($doctor);
            $doctor->setDoctor($this);
        }

        return $this;
    }

    public function removeDoctor(Appointment $doctor): self
    {
        if ($this->doctor->removeElement($doctor)) {
            // set the owning side to null (unless already changed)
            if ($doctor->getDoctor() === $this) {
                $doctor->setDoctor(null);
            }
        }

        return $this;
    }
}
