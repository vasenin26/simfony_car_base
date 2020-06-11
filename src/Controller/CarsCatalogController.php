<?php

namespace App\Controller;

use App\DataObjects\CarSearchOptions;
use App\Entity\Cars;
use App\Services\Interfaces\CarManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarsCatalogController extends AbstractController
{

    /**
     * @Route("/cars/create", name="cars_create")
     * @param EntityManager $manager
     * @return JsonResponse
     * @throws ORMException
     */
    public function create(EntityManager $manager): JsonResponse
    {
        $car = new Cars();

        $car->setTitle('Test');

        $manager->persist($car);

        return $this->json([
            'ok' => []
        ]);
    }

    /**
     * @Route("/cars/search", name="cars_search")
     * @param CarManager $carManager
     * @param CarSearchOptions $carSearchOptions
     * @return JsonResponse
     */
    public function search(CarManager $carManager, CarSearchOptions $carSearchOptions): JsonResponse
    {
        return $this->json([
            'items' => $carManager->searchCars($carSearchOptions)
        ]);
    }

    /**
     * @Route("/cars/latest", name="cars_latest")
     */
    public function latest(): JsonResponse
    {
        return $this->json([
            'items' => []
        ]);
    }
}