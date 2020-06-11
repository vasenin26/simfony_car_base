<?php
/**
 * Filename: CarManager.php
 * Creator: Vasenin Leonid {leonid.vasenin@gmail.com}
 * Date: 11.06.2020
 */

namespace App\Services\Interfaces;


use App\DataObjects\CarSearchOptions;

interface CarManager
{
    public function searchCars(?CarSearchOptions $options = null): array;
    public function getLatestCars(int $limit): array;
}