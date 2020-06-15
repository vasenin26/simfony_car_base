<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
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
     * @ORM\Column(type="boolean")
     */
    private $is_new;

    /**
     * @ORM\Column(type="date")
     */
    private $production_data;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_rain_sensor;

    /**
     * @ORM\Column(type="integer")
     */
    private $vendor_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $mileage;

    /**
     * @ORM\ManyToOne(targetEntity=Vendors::class)
     * @ORM\JoinColumn(name="vendor_id", referencedColumnName="id")
     */
    private $vendors;

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

    public function getIsNew(): ?bool
    {
        return $this->is_new;
    }

    public function setIsNew(bool $is_new): self
    {
        $this->is_new = $is_new;

        return $this;
    }

    public function getProductionData(): ?\DateTimeInterface
    {
        return $this->production_data;
    }

    public function setProductionData(\DateTimeInterface $production_data): self
    {
        $this->production_data = $production_data;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIsRainSensor(): ?bool
    {
        return $this->is_rain_sensor;
    }

    public function setIsRainSensor(bool $is_rain_sensor): self
    {
        $this->is_rain_sensor = $is_rain_sensor;

        return $this;
    }

    public function getVendorId(): ?int
    {
        return $this->vendor_id;
    }

    public function setVendorId(int $vendor_id): self
    {
        $this->vendor_id = $vendor_id;

        return $this;
    }

    public function getMileage()
    {
        return $this->mileage;
    }

    public function setMileage($mileage): void
    {
        $this->mileage = $mileage;
    }

    public function getVendors(): ?Vendors
    {
        return $this->vendors;
    }

    public function setVendors(Vendors $vendors): self
    {
        $this->vendors = $vendors;

        return $this;
    }
}
