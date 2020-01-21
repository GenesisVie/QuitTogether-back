<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CigaretteRepository")
 */
class Cigarette
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $feelings = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $intensity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cigarettes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFeelings(): ?array
    {
        return $this->feelings;
    }

    public function setFeelings(array $feelings): self
    {
        $this->feelings = $feelings;

        return $this;
    }

    public function getIntensity(): ?int
    {
        return $this->intensity;
    }

    public function setIntensity(int $intensity): self
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): self
    {
        $this->reason = $reason;

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
