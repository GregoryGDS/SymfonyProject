<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoGameRepository")
 */
class VideoGame
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le titre du jeu ne peut pas être vide")
     * @Assert\Length(min="2", minMessage="Le titre du jeu est trop petit",
     * max="255", maxMessage="Le titre du jeu est trop long")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom du support ne peut pas être vide")
     * @Assert\Length(min="2", minMessage="Le nom du support est trop petit",
     * max="255", maxMessage="Le nom du support est trop long")
     */
    private $support;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Il doit y avoir une description")
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Type(type="DateTime")
     */
    private $releaseDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Editor", inversedBy="videoGames")
     * @ORM\JoinColumn(nullable=true)
     */
    private $gameEditor;

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

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getGameEditor(): ?Editor
    {
        return $this->gameEditor;
    }

    public function setGameEditor(?Editor $gameEditor): self
    {
        $this->gameEditor = $gameEditor;

        return $this;
    }
}
