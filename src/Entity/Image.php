<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /** 
     * @var UploadedFile
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of file
     * @return  UploadedFile
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     * @param  UploadedFile  $file
     * @return  self
     */ 
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
