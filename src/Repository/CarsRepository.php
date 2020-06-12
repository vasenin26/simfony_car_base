<?php

namespace App\Repository;

use App\DataObjects\CarSearchOptions;
use App\Entity\Cars;
use App\Interfaces\CarManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cars[]    findAll()
 * @method Cars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsRepository extends ServiceEntityRepository implements CarManager
{
    const DEFAULT_MAX_RESULT = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cars::class);
    }

    public function searchCars(?CarSearchOptions $options = null): array
    {
        $builder = $this->createQueryBuilder('cars');
        $criteria = Criteria::create();

        if($options){
            $options->defineCriteria($criteria);
        }

        $result = $builder->addCriteria($criteria)->getQuery()->execute();

        if(!is_array($result)){
            return  [];
        }

        return $result;
    }

    public function getLatestCars(?int $limit = null): array
    {
        $result = $this->createQueryBuilder('cars')
            ->orderBy('created_at', 'desc')
            ->setMaxResults($limit ?? self::DEFAULT_MAX_RESULT)
            ->getQuery()->execute();

        return $result ?? [];
    }

}
