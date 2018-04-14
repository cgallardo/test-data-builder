<?php

declare(strict_types=1);

namespace Bookings;

class Listing
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $landlordId;

    /**
     * @var int
     */
    private $monthlyPrice;

    public function __construct(string $id, string $landlordId, int $monthlyPrice)
    {
        $this->id           = $id;
        $this->landlordId   = $landlordId;
        $this->monthlyPrice = $monthlyPrice;
    }

    public function monthlyPrice(): int
    {
        return $this->monthlyPrice;
    }
}
