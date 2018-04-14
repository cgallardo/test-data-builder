<?php

declare(strict_types=1);

namespace BookingsTests;

use Bookings\Booking;
use Bookings\Listing;
use Bookings\Tenant;

class BookingObjectMother
{
    public static function newBookingWithTenantAndListing(Tenant $tenant, Listing $listing): Booking
    {
        return new Booking(
            $listing,
            new \DateTimeImmutable('2018-05-01'),
            new \DateTimeImmutable('2019-01-31'),
            $tenant
        );
    }




    public static function newBookingWithTenantAndListingAndDiscount(
        Tenant $tenant,
        Listing $listing,
        float $discount
    ): Booking {
        return new Booking(
            $listing,
            new \DateTimeImmutable('2018-05-01'),
            new \DateTimeImmutable('2019-01-31'),
            $tenant,
            $discount
        );
    }
}
