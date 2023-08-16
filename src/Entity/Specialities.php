<?php

namespace App\Entity;

use App\Repository\SpecialitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialitiesRepository::class)]
class Specialities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $names = null;

    #[ORM\OneToMany(mappedBy: 'specialities', targetEntity: Doctor::class)]
    private Collection $doctor;

    public function __construct()
    {
        $this->doctor = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNames(): ?string
    {
        return $this->names;
    }

    public function setNames(?string $names): self
    {
        $this->names = $names;

        return $this;
    }

    /**
     * @return Collection<int, Doctor>
     */
    public function getDoctor(): Collection
    {
        return $this->doctor;
    }

    public function addDoctor(Doctor $doctor): self
    {
        if (!$this->doctor->contains($doctor)) {
            $this->doctor->add($doctor);
            $doctor->setSpecialities($this);
        }

        return $this;
    }

    public function removeDoctor(Doctor $doctor): self
    {
        if ($this->doctor->removeElement($doctor)) {
            // set the owning side to null (unless already changed)
            if ($doctor->getSpecialities() === $this) {
                $doctor->setSpecialities(null);
            }
        }

        return $this;
    }
}
