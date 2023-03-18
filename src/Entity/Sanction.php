<?php

namespace App\Entity;

use App\Repository\SanctionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SanctionRepository::class)]
class Sanction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?int $ban_duration = null;

    #[ORM\ManyToOne(inversedBy: 'sanctions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorySanction $category = null;

    #[ORM\ManyToOne(inversedBy: 'sanctions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getBanDuration(): ?int
    {
        return $this->ban_duration;
    }

    public function setBanDuration(int $ban_duration): self
    {
        $this->ban_duration = $ban_duration;

        return $this;
    }

    public function getCategory(): ?CategorySanction
    {
        return $this->category;
    }

    public function setCategory(?CategorySanction $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
