<?php

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Bug::class, mappedBy: 'reporter')]
    private Collection $reportedBugs;

    #[ORM\OneToMany(targetEntity: Bug::class, mappedBy: 'engineer')]
    private Collection $assignedBugs;

    public function __construct()
    {
        $this->reportedBugs = new ArrayCollection();
        $this->assignedBugs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addReportedBug(Bug $bug): void
    {
        $this->reportedBugs[] = $bug;
    }

    public function getReportedBugs(): Collection
    {
        return $this->reportedBugs;
    }

    public function addAssignedBug(Bug $bug): void
    {
        $this->assignedBugs[] = $bug;
    }

    public function getAssignedBugs(): Collection
    {
        return $this->assignedBugs;
    }
}
