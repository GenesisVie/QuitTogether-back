<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FriendRepository")
 */
class Friend
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $displaying;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="friends")
     */
    private $friend;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplaying(): ?bool
    {
        return $this->displaying;
    }

    public function setDisplaying(?bool $displaying): self
    {
        $this->displaying = $displaying;

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

    public function getFriend(): ?User
    {
        return $this->friend;
    }

    public function setFriend(?User $friend): self
    {
        $this->friend = $friend;

        return $this;
    }
}
