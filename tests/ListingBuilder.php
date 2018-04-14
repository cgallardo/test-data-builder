<?php

declare(strict_types=1);

namespace BookingsTests;

use Bookings\Listing;

class ListingBuilder
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

    public static function aListing(): self
    {
        return new self;
    }

    public function withId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withLandlordId(string $landlordId): self
    {
        $this->landlordId = $landlordId;

        return $this;
    }

    public function withMonthlyPrice(int $monthlyPrice): self
    {
        $this->monthlyPrice = $monthlyPrice;

        return $this;
    }

    public function build(): Listing
    {
        return new Listing(
            $this->id,
            $this->landlordId,
            $this->monthlyPrice
        );
    }
}
