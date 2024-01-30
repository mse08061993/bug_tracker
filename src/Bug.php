<?php

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'bugs')]
class Bug
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id;

    #[ORM\Column(type: Types::STRING)]
    private string $description;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTime $created;

    #[ORM\Column(type: Types::STRING)]
    private string $type;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reportedBugs')]
    private User $reporter;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'assignedBugs')]
    private User $engineer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setReporter(User $reporter): void
    {
        $this->reporter = $reporter;
        $reporter->addReportedBug($this);
    }

    public function getReporter(): User
    {
        return $this->reporter;
    }

    public function setEngineer(User $engineer): void
    {
        $this->engineer = $engineer;
        $engineer->addAssignedBug($this);
    }

    public function getEngineer(): User
    {
        return $this->engineer;
    }
}
