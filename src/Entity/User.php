<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $stoppedAt;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $packageCost;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cigarette", mappedBy="user")
     */
    private $cigarettes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AchievementUser", mappedBy="user")
     */
    private $achievementUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="user")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Friend", mappedBy="friend")
     */
    private $friends;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="user")
     */
    private $userStats;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersist()
    {
        $this->setBirthday(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $this->setStoppedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $this->setUpdatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
    }

    public function __construct()
    {
        $this->setCreatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $this->setBirthday(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $this->setStoppedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $this->setUpdatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $this->cigarettes = new ArrayCollection();
        $this->achievementUsers = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->userStats = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStoppedAt(): ?\DateTimeInterface
    {
        return $this->stoppedAt;
    }

    public function setStoppedAt(\DateTimeInterface $stoppedAt): self
    {
        $this->stoppedAt = $stoppedAt;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPackageCost(): ?int
    {
        return $this->packageCost;
    }

    public function setPackageCost(?int $packageCost): self
    {
        $this->packageCost = $packageCost;

        return $this;
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
    public function getUsername(): string
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Cigarette[]
     */
    public function getCigarettes(): Collection
    {
        return $this->cigarettes;
    }

    public function addCigarette(Cigarette $cigarette): self
    {
        if (!$this->cigarettes->contains($cigarette)) {
            $this->cigarettes[] = $cigarette;
            $cigarette->setUser($this);
        }

        return $this;
    }

    public function removeCigarette(Cigarette $cigarette): self
    {
        if ($this->cigarettes->contains($cigarette)) {
            $this->cigarettes->removeElement($cigarette);
            // set the owning side to null (unless already changed)
            if ($cigarette->getUser() === $this) {
                $cigarette->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AchievementUser[]
     */
    public function getAchievementUsers(): Collection
    {
        return $this->achievementUsers;
    }

    public function addAchievementUser(AchievementUser $achievementUser): self
    {
        if (!$this->achievementUsers->contains($achievementUser)) {
            $this->achievementUsers[] = $achievementUser;
            $achievementUser->setUser($this);
        }

        return $this;
    }

    public function removeAchievementUser(AchievementUser $achievementUser): self
    {
        if ($this->achievementUsers->contains($achievementUser)) {
            $this->achievementUsers->removeElement($achievementUser);
            // set the owning side to null (unless already changed)
            if ($achievementUser->getUser() === $this) {
                $achievementUser->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setUser($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getUser() === $this) {
                $note->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Friend[]
     */
    public function getFriends(): Collection
    {
        return $this->friends;
    }

    public function addFriend(Friend $friend): self
    {
        if (!$this->friends->contains($friend)) {
            $this->friends[] = $friend;
            $friend->setFriend($this);
        }

        return $this;
    }

    public function removeFriend(Friend $friend): self
    {
        if ($this->friends->contains($friend)) {
            $this->friends->removeElement($friend);
            // set the owning side to null (unless already changed)
            if ($friend->getFriend() === $this) {
                $friend->setFriend(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserStat[]
     */
    public function getUserStats(): Collection
    {
        return $this->userStats;
    }

    public function addUserStat(UserStat $userStat): self
    {
        if (!$this->userStats->contains($userStat)) {
            $this->userStats[] = $userStat;
            $userStat->setUser($this);
        }

        return $this;
    }

    public function removeUserStat(UserStat $userStat): self
    {
        if ($this->userStats->contains($userStat)) {
            $this->userStats->removeElement($userStat);
            // set the owning side to null (unless already changed)
            if ($userStat->getUser() === $this) {
                $userStat->setUser(null);
            }
        }

        return $this;
    }
}
