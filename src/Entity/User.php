<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_of_birth = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $account_creation_date = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Sanction::class)]
    private Collection $sanctions;

    #[ORM\OneToMany(mappedBy: 'writed_by', targetEntity: Article::class)]
    private Collection $articles_writed;

    #[ORM\OneToMany(mappedBy: 'validated_by', targetEntity: Article::class)]
    private Collection $articles_validated;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Publication::class)]
    private Collection $publications;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    public function __construct()
    {
        $this->sanctions = new ArrayCollection();
        $this->articles_writed = new ArrayCollection();
        $this->articles_validated = new ArrayCollection();
        $this->publications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getAccountCreationDate(): ?\DateTimeInterface
    {
        return $this->account_creation_date;
    }

    public function setAccountCreationDate(\DateTimeInterface $account_creation_date): self
    {
        $this->account_creation_date = $account_creation_date;

        return $this;
    }

    /**
     * @return Collection<int, Sanction>
     */
    public function getSanctions(): Collection
    {
        return $this->sanctions;
    }

    public function addSanction(Sanction $sanction): self
    {
        if (!$this->sanctions->contains($sanction)) {
            $this->sanctions->add($sanction);
            $sanction->setUser($this);
        }

        return $this;
    }

    public function removeSanction(Sanction $sanction): self
    {
        if ($this->sanctions->removeElement($sanction)) {
            // set the owning side to null (unless already changed)
            if ($sanction->getUser() === $this) {
                $sanction->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticlesWrited(): Collection
    {
        return $this->articles_writed;
    }

    public function addArticlesWrited(Article $articlesWrited): self
    {
        if (!$this->articles_writed->contains($articlesWrited)) {
            $this->articles_writed->add($articlesWrited);
            $articlesWrited->setWritedBy($this);
        }

        return $this;
    }

    public function removeArticlesWrited(Article $articlesWrited): self
    {
        if ($this->articles_writed->removeElement($articlesWrited)) {
            // set the owning side to null (unless already changed)
            if ($articlesWrited->getWritedBy() === $this) {
                $articlesWrited->setWritedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticlesValidated(): Collection
    {
        return $this->articles_validated;
    }

    public function addArticlesValidated(Article $articlesValidated): self
    {
        if (!$this->articles_validated->contains($articlesValidated)) {
            $this->articles_validated->add($articlesValidated);
            $articlesValidated->setValidatedBy($this);
        }

        return $this;
    }

    public function removeArticlesValidated(Article $articlesValidated): self
    {
        if ($this->articles_validated->removeElement($articlesValidated)) {
            // set the owning side to null (unless already changed)
            if ($articlesValidated->getValidatedBy() === $this) {
                $articlesValidated->setValidatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Publication>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications->add($publication);
            $publication->setUser($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getUser() === $this) {
                $publication->setUser(null);
            }
        }

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
