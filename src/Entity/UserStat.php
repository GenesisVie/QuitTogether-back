<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserStatRepository")
 */
class UserStat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $moneyEconomised;

    /**
     * @ORM\Column(type="integer")
     */
    private $cigarettesSaved;

    /**
     * @ORM\Column(type="integer")
     */
    private $lifetimeSaved;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Statistics", inversedBy="userStats")
     */
    private $statistic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userStats")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageUrl;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function prePersist()
    {
        $this->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
    }

    public function __construct()
    {
        $this->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
    }

    public function __toString()
    {
        return (string)$this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMoneyEconomised(): ?float
    {
        return $this->moneyEconomised;
    }

    public function setMoneyEconomised(float $moneyEconomised): self
    {
        $this->moneyEconomised = $moneyEconomised;

        return $this;
    }

    public function getCigarettesSaved(): ?int
    {
        return $this->cigarettesSaved;
    }

    public function setCigarettesSaved(int $cigarettesSaved): self
    {
        $this->cigarettesSaved = $cigarettesSaved;

        return $this;
    }

    public function getLifetimeSaved(): ?int
    {
        return $this->lifetimeSaved;
    }

    public function setLifetimeSaved(int $lifetimeSaved): self
    {
        $this->lifetimeSaved = $lifetimeSaved;

        return $this;
    }

    public function getStatistic(): ?Statistics
    {
        return $this->statistic;
    }

    public function setStatistic(?Statistics $statistic): self
    {
        $this->statistic = $statistic;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
