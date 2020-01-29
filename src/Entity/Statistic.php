<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatisticRepository")
 */
class Statistic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @ORM\Column(type="float")
     */
    private $timeSaved;

    /**
     * @ORM\Column(type="integer")
     */
    private $lifetimeSaved;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStat", inversedBy="statistics")
     */
    private $UserStat;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getUserStat(): ?UserStat
    {
        return $this->UserStat;
    }

    public function setUserStat(?UserStat $UserStat): self
    {
        $this->UserStat = $UserStat;

        return $this;
    }
}
