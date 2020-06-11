<?php
/**
 * Filename: CarSearchOptions.php
 * Creator: Vasenin Leonid {leonid.vasenin@gmail.com}
 * Date: 11.06.2020
 */

namespace App\DataObjects;

use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\RequestStack;

class CarSearchOptions
{
    const IS_NEW = 'is_new';
    const MANUFACTURED_ID = 'manufactured_id';
    const BUILD_YEAR_FROM = 'build_year_from';
    const BUILD_YEAR_TO = 'build_year_to';
    const PRICE_FROM = 'price_from';
    const PRICE_TO = 'price_to';
    const IS_RAIN_SENSOR = 'is_rain_sensor';

    const OPTION_CASTS = [
        self::IS_NEW => 'TinyInt',
        self::MANUFACTURED_ID => 'Int',
        self::BUILD_YEAR_FROM => 'Year',
        self::BUILD_YEAR_TO => 'Year',
        self::PRICE_FROM => 'Int',
        self::PRICE_TO => 'Int',
        self::IS_RAIN_SENSOR => 'TinyInt',
    ];

    /**
     * @var array
     */
    private $attributes = [];

    public function __construct(RequestStack $request)
    {
        $this->fill($request->getCurrentRequest()->query->all());
    }

    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set(string $key, $value): self
    {
        $castMethod = self::OPTION_CASTS[$key] ?? null;

        if (is_null($castMethod)) {
            return $this;
        }

        $value = $this->{'cast' . $castMethod}($value);

        $this->attributes[$key] = $value;

        return $this;
    }

    public function fill(array $options): self
    {
        foreach (self::OPTION_CASTS as $key => $castMethod) {
            if (array_key_exists($key, $options)) {
                $this->$key = $options[$key];
            }
        }

        return $this;
    }

    public function defineCriteria(Criteria $criteria): Criteria
    {
        foreach([
            self::IS_NEW => function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->eq(self::IS_NEW, $value));
            },
            self::MANUFACTURED_ID => function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->eq(self::MANUFACTURED_ID, $value));
            },
            self::BUILD_YEAR_FROM => function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->gte(self::BUILD_YEAR_FROM, $value));
            },
            self::BUILD_YEAR_TO => function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->lte(self::BUILD_YEAR_TO, $value));
            },
            self::PRICE_FROM=> function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->gte(self::PRICE_FROM, $value));
            },
            self::PRICE_TO => function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->lte(self::PRICE_TO, $value));
            },
            self::IS_RAIN_SENSOR => function (Criteria $criteria, $value) {
                return $criteria->andWhere(Criteria::expr()->eq(self::IS_RAIN_SENSOR, $value));
            },
        ] as $key => $fu){
            if(isset($this->attributes[$key])){
                $fu($criteria, $this->attributes[$key]);
            }
        }

        return $criteria;
    }

    private function castTinyInt($value): int
    {
        return (int)($value > 0);
    }

    private function castInt($value): int
    {
        return (int)$value;
    }

    private function castYear($value): int
    {
        //we can check that year less current year
        return (int)($value);
    }
}