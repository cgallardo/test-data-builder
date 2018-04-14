<?php

declare(strict_types=1);

namespace BookingsTests;

use Bookings\Booking;
use Bookings\Listing;
use Bookings\Tenant;

class BookingBuilder
{
    /**
     * @var Listing
     */
    private $listing;

    /**
     * @var Tenant
     */
    private $tenant;

    /**
     * @var \DateTimeImmutable
     */
    private $checkIn;

    /**
     * @var \DateTimeImmutable
     */
    private $checkOut;

    /**
     * @var float
     */
    private $discount = 0.00;

    public static function aBooking(): self
    {
        return new self;
    }

    public function withListing(Listing $listing): self
    {
        $this->listing = $listing;

        return $this;
    }

    public function withTenant(Tenant $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function withCheckIn(\DateTimeImmutable $checkIn): self
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    public function withCheckOut(\DateTimeImmutable $checkOut): self
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    public function withDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function withNoDiscount(): self
    {
        $this->discount = 0.00;

        return $this;
    }

    public function build(): Booking
    {
        return new Booking(
            $this->listing,
            $this->checkIn,
            $this->checkOut,
            $this->tenant,
            $this->discount
        );
    }

    public function but(): self
    {
        return clone $this;
    }

    public function fromTenant(TenantBuilder $tenantBuilder): self
    {
        $this->tenant = $tenantBuilder->build();

        return $this;
    }

    public function forListing(ListingBuilder $listingBuilder): self
    {
        $this->listing = $listingBuilder->build();

        return $this;
    }

    public function from(TenantBuilder $tenantBuilder)
    {
        $this->tenant = $tenantBuilder->build();

        return $this;
    }

    public function for(ListingBuilder $listingBuilder): self
    {
        $this->listing = $listingBuilder->build();

        return $this;
    }

    public function checkingInOn(\DateTimeImmutable $checkIn): self
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    public function checkingOutOn(\DateTimeImmutable $checkOut): self
    {
        $this->checkOut = $checkOut;

        return $this;
    }
}
