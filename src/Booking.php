<?php

declare(strict_types=1);

namespace Bookings;

class Booking
{
    private const BOOKING_FEE_PERCENTAGE = 0.10;

    /**
     * @var Listing
     */
    private $listing;

    /**
     * @var \DateTimeImmutable
     */
    private $checkIn;

    /**
     * @var \DateTimeImmutable
     */
    private $checkOut;

    /**
     * @var Tenant
     */
    private $tenant;

    /**
     * @var float
     */
    private $discount;

    public function __construct(
        Listing $listing,
        \DateTimeImmutable $checkIn,
        \DateTimeImmutable $checkOut,
        Tenant $tenant,
        float $discount = 0.00
    ) {
        $this->listing  = $listing;
        $this->checkIn  = $checkIn;
        $this->checkOut = $checkOut;
        $this->tenant   = $tenant;
        $this->discount = $discount;
    }

    public function totalPrice(): int
    {
        $priceContract = $this->numberOfMonths() * $this->listing->monthlyPrice();
        $fee           = $priceContract * self::BOOKING_FEE_PERCENTAGE;
        $discount      = $fee * $this->discount;

        return (int) ($priceContract + $fee - $discount);
    }

    public function numberOfMonths(): int
    {
        $diff = $this->checkIn->diff($this->checkOut, true);

        return ($diff->y * 12) + $diff->m + ($diff->d > 0 ? 1 : 0);
    }
}
