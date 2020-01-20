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
    private $MoneyEconomised;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbCigarettesSaved;

    /**
     * @ORM\Column(type="integer")
     */
    private $Since;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="userStat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserId;

    /**
     * @ORM\Column(type="float")
     */
    private $TimeSaved;

    /**
     * @ORM\Column(type="integer")
     */
    private $LifetimeSaved;


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
        return $this->MoneyEconomised;
    }

    public function setMoneyEconomised(float $MoneyEconomised): self
    {
        $this->MoneyEconomised = $MoneyEconomised;

        return $this;
    }

    public function getNbCigarettesSaved(): ?int
    {
        return $this->NbCigarettesSaved;
    }

    public function setNbCigarettesSaved(int $NbCigarettesSaved): self
    {
        $this->NbCigarettesSaved = $NbCigarettesSaved;

        return $this;
    }

    public function getSince(): ?int
    {
        return $this->Since;
    }

    public function setSince(int $Since): self
    {
        $this->Since = $Since;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->UserId;
    }

    public function setUserId(User $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getTimeSaved(): ?float
    {
        return $this->TimeSaved;
    }

    public function setTimeSaved(float $TimeSaved): self
    {
        $this->TimeSaved = $TimeSaved;

        return $this;
    }

    public function getLifetimeSaved(): ?int
    {
        return $this->LifetimeSaved;
    }

    public function setLifetimeSaved(int $LifetimeSaved): self
    {
        $this->LifetimeSaved = $LifetimeSaved;

        return $this;
    }

  
}
