<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AchievementRepository")
 */
class Achievement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AchievementUser", mappedBy="achievement")
     */
    private $achievementUsers;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $unsmokedCigarette;

    public function __construct()
    {
        $this->achievementUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

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
            $achievementUser->setAchievement($this);
        }

        return $this;
    }

    public function removeAchievementUser(AchievementUser $achievementUser): self
    {
        if ($this->achievementUsers->contains($achievementUser)) {
            $this->achievementUsers->removeElement($achievementUser);
            // set the owning side to null (unless already changed)
            if ($achievementUser->getAchievement() === $this) {
                $achievementUser->setAchievement(null);
            }
        }

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getUnsmokedCigarette(): ?int
    {
        return $this->unsmokedCigarette;
    }

    public function setUnsmokedCigarette(int $unsmokedCigarette): self
    {
        $this->unsmokedCigarette = $unsmokedCigarette;

        return $this;
    }
}
