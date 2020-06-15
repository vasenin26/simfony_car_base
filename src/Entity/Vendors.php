<?php

namespace App\Entity;

use App\Repository\VendorsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=VendorsRepository::class)
 */
class Vendors
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity=Cars::class,fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="vendor_id")
     */
    private $cars;

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
}
