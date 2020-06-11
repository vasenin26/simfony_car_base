<?php
/**
 * Filename: CarService.php
 * Creator: Vasenin Leonid {leonid.vasenin@gmail.com}
 * Date: 11.06.2020
 */

namespace App\Services;


use App\DataObjects\CarSearchOptions;
use App\Services\Interfaces\CarManager;
use Doctrine\ORM\EntityManagerInterface;

class CarService implements CarManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function searchCars(?CarSearchOptions $options = null): array
    {
        // TODO: Implement searchCars() method.
        return ['a' => 'd'];
    }

    public function getLatestCars(int $limit): array
    {
        // TODO: Implement getLatestCars() method.
        return [];
    }
}