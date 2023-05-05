<?php

namespace App\Repositories;


use App\Interfaces\MarketRepositoryInterface;
use App\Models\Market;

class MarketRepository extends AbstractRepository implements MarketRepositoryInterface
{
    public function __construct(Market $market)
    {
        parent::__construct($market);
    }
}
