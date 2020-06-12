<?php

namespace App\Command;

use App\DataObjects\CarSearchOptions;
use App\Repository\CarsRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CarsResetMillageCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'cars:reset-millage';

    /**
     * @var CarsRepository
     */
    private CarsRepository $carsRepository;

    /**
     * Default mileage for mileage reducing
     */
    const DEFAULT_MIN_MILEAGE = 150000;

    public function __construct(CarsRepository $carsRepository)
    {
        parent::__construct();
        $this->carsRepository = $carsRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription('Reduce vehicle mileage')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Min mileage');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $searchOptions = new carSearchOptions();

        $minMillage = $io->ask("Min mileage for reduce", self::DEFAULT_MIN_MILEAGE);
        $reducePercentage = $io->ask("Reduce percentage", CarsRepository::DEFAULT_REDUCE_PERCENTAGE);

        $searchOptions->{carSearchOptions::MILEAGE_FROM} = $minMillage;

        $query = $this->carsRepository->loseCarsMileage($searchOptions, $reducePercentage);

        $io->success("Fetched: $query");

        return 0;
    }
}
