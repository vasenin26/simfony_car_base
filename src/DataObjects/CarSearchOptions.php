<?php
/**
 * Filename: CarSearchOptions.php
 * Creator: Vasenin Leonid {leonid.vasenin@gmail.com}
 * Date: 11.06.2020
 */

namespace App\DataObjects;

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