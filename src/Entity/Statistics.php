<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\StatisticsRepository")
 * @Vich\Uploadable
 */
class Statistics
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="stat_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @ORM\Column(type="float")
     */
    private $moneyEconomised;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lifetimeSaved;

    /**
     * @ORM\Column(type="integer")
     */
    private $unsmokedCigarette;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserStat", mappedBy="statistic")
     * @ORM\JoinColumn(onDelete="cascade")
     */
    private $userStats;

    public function __construct()
    {
        $this->userStats = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
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

    public function getLifetimeSaved(): ?string
    {
        return $this->lifetimeSaved;
    }

    public function setLifetimeSaved(string $lifetimeSaved): self
    {
        $this->lifetimeSaved = $lifetimeSaved;

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
            $userStat->setStatistic($this);
        }

        return $this;
    }

    public function removeUserStat(UserStat $userStat): self
    {
        if ($this->userStats->contains($userStat)) {
            $this->userStats->removeElement($userStat);
            // set the owning side to null (unless already changed)
            if ($userStat->getStatistic() === $this) {
                $userStat->setStatistic(null);
            }
        }

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
}
