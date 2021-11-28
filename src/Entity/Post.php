<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Artist::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="post", cascade={"persist"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="post", cascade={"persist"}, orphanRemoval=true)
     */
    private $videos;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $addedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tags;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Image $image
     * @return void
     */
    public function addImage(Image $image): void
    {
        $image->setPost($this);
        $this->images->add($image);
    }

    /**
     * @param Image $image
     * @return void
     */
    public function removeImage(Image $image): void
    {
        $image->setPost(null);
        $this->images->removeElement($image);
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    /**
     * @param Video $video
     * @return void
     */
    public function addVideo(Video $video): void
    {
        $video->setPost($this);
        $this->videos->add($video);
    }

    /**
     * @param Video $video
     * @return void
     */
    public function removeVideo(Video $video): void
    {
        $video->setPost(null);
        $this->videos->removeElement($video);
    }

    public function getAddedAt(): ?\DateTimeImmutable
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeImmutable $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }
}
