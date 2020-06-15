<?php

namespace App\Controller;

use App\DataObjects\CarSearchOptions;
use App\Entity\Cars;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Interfaces\CarManager;

class CarsCatalogController extends AbstractController
{

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
     * @param CarManager $carManager
     * @return JsonResponse
     */
    public function latest(CarManager $carManager): JsonResponse
    {
        return $this->json([
            'items' => $carManager->getLatestCars()
        ]);
    }
}
