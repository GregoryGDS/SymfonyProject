<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EditorRepository")
 */
class Editor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom d'entreprise ne peut pas être vide")
     * @Assert\Length(min="2", minMessage="Le nom d'entreprise est trop petit",
     * max="255", maxMessage="Le nom d'entreprise est trop long")
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom de la nationalité ne peut pas être vide")
     * @Assert\Length(min="2", minMessage="Le nom de la nationalité est trop petit",
     * max="255", maxMessage="Le nom de la nationalité est trop long")
     */
    private $nationality;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VideoGame", mappedBy="gameEditor")
     */
    private $videoGames;

    public function __construct()
    {
        $this->videoGames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return Collection|VideoGame[]
     */
    public function getVideoGames(): Collection
    {
        return $this->videoGames;
    }

    public function addVideoGame(VideoGame $videoGame): self
    {
        if (!$this->videoGames->contains($videoGame)) {
            $this->videoGames[] = $videoGame;
            $videoGame->setGameEditor($this);
        }

        return $this;
    }

    public function removeVideoGame(VideoGame $videoGame): self
    {
        if ($this->videoGames->contains($videoGame)) {
            $this->videoGames->removeElement($videoGame);
            // set the owning side to null (unless already changed)
            if ($videoGame->getGameEditor() === $this) {
                $videoGame->setGameEditor(null);
            }
        }

        return $this;
    }
}
