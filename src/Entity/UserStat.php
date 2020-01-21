<?php

namespace App\Entity;

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
    private $since;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="userStat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="float")
     */
    private $timeSaved;

    /**
     * @ORM\Column(type="integer")
     */
    private $lifetimeSaved;


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

    public function getSince(): ?int
    {
        return $this->since;
    }

    public function setSince(int $since): self
    {
        $this->since = $since;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getTimeSaved(): ?float
    {
        return $this->timeSaved;
    }

    public function setTimeSaved(float $timeSaved): self
    {
        $this->timeSaved = $timeSaved;

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

  
}
