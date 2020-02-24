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
    private $since;

    /**
     * @ORM\Column(type="integer")
     */
    private $lifetimeSaved;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="statistic", cascade={"persist", "remove"})
     */
    private $user;

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

    public function getSince(): ?int
    {
        return $this->since;
    }

    public function setSince(int $since): self
    {
        $this->since = $since;

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
