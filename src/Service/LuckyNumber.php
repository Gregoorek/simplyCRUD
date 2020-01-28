<?php


namespace App\Service;


use Psr\Log\LoggerInterface;

class LuckyNumber
{
    private $logger;
    private $max;
    public function __construct(int $max ,LoggerInterface $logger)
    {
        $this->max=$max;
        $this->logger = $logger;
    }
    
    public function getNumber():int
    {
        $number = rand(1,$this->max);
        $this->logger->debug("wyloswoana liczba ".$number);
        return $number;
    }
}