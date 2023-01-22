<?php

namespace App\Entity;

use App\Repository\ArtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtRepository::class)]
class Art
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column(length: 255)]
    private ?string $artist = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'art_id')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Category $category_id = null;

    #[ORM\OneToMany(mappedBy: 'art', targetEntity: Comments::class)]
    private Collection $comment_id;

    public function __construct()
    {
        $this->comment_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->category_id;
    }

    public function setCategoryId(?Category $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getCommentId(): Collection
    {
        return $this->comment_id;
    }

    public function addCommentId(Comments $commentId): self
    {
        if (!$this->comment_id->contains($commentId)) {
            $this->comment_id->add($commentId);
            $commentId->setArt($this);
        }

        return $this;
    }

    public function removeCommentId(Comments $commentId): self
    {
        if ($this->comment_id->removeElement($commentId)) {
            // set the owning side to null (unless already changed)
            if ($commentId->getArt() === $this) {
                $commentId->setArt(null);
            }
        }

        return $this;
    }
}
