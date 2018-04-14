<?php

declare(strict_types=1);

namespace BookingsTests;

use Bookings\Booking;
use Bookings\Listing;
use Bookings\Tenant;
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase
{
    /**
     * @test
     */
    public function priceShouldBeLowerWhenHavingADiscount()
    {
        $bookingA = new Booking(
            new Listing(
                '1',
                'xx',
                100
            ),
            new \DateTimeImmutable('2018-05-01'),
            new \DateTimeImmutable('2019-01-31'),
            new Tenant(
                'Carlos Gallardo',
                '620101010',
                'test@gmail.com'
            )
        );

        $bookingB = new Booking(
            new Listing(
                '2',
                'xx',
                100
            ),
            new \DateTimeImmutable('2018-05-01'),
            new \DateTimeImmutable('2019-01-31'),
            new Tenant(
                'María Gallardo',
                '620202020',
                'test2@gmail.com'
            ),
            0.50
        );

        $this->assertTrue($bookingB->totalPrice() < $bookingA->totalPrice());
    }

    /**
     * @test
     */
    public function priceShouldBeLowerWhenHavingADiscountWithObjectMother()
    {
        $bookingA = BookingObjectMother::newBookingWithTenantAndListing(
            new Tenant(
                'Carlos Gallardo',
                '620101010',
                'test@gmail.com'
            ),
            new Listing(
                '1',
                'xx',
                100
            )
        );

        $bookingB = BookingObjectMother::newBookingWithTenantAndListingAndDiscount(
            new Tenant(
                'Carlos Gallardo',
                '620101010',
                'test1@gmail.com'
            ),
            new Listing(
                '1',
                'xx',
                100
            ),
            0.50
        );

        $this->assertTrue($bookingB->totalPrice() < $bookingA->totalPrice());
    }

    /**
     * @test
     */
    public function priceShouldBeLowerWhenHavingADiscountWithDataBuilders()
    {
        $bookingA = BookingBuilder::aBooking()
            ->withListing(
                ListingBuilder::aListing()
                    ->withId('1')
                    ->withLandlordId('xx')
                    ->withMonthlyPrice(100)
                    ->build()
            )
            ->withTenant(
                TenantBuilder::aTenant()
                    ->withFullName('Carlos Gallardo')
                    ->withPhoneNumber('620101010')
                    ->withEmail('test@gmail.com')
                    ->build()
            )
            ->withCheckIn(new \DateTimeImmutable('2018-05-01'))
            ->withCheckOut(new \DateTimeImmutable('2019-01-31'))
            ->withNoDiscount()
            ->build();

        $bookingB = BookingBuilder::aBooking()
            ->withListing(
                ListingBuilder::aListing()
                    ->withId('1')
                    ->withLandlordId('xx')
                    ->withMonthlyPrice(100)
                    ->build()
            )
            ->withTenant(
                TenantBuilder::aTenant()
                    ->withFullName('Carlos Gallardo')
                    ->withPhoneNumber('620101010')
                    ->withEmail('test@gmail.com')
                    ->build()
            )
            ->withCheckIn(new \DateTimeImmutable('2018-05-01'))
            ->withCheckOut(new \DateTimeImmutable('2019-01-31'))
            ->withDiscount(0.50)
            ->build();

        $this->assertTrue($bookingB->totalPrice() < $bookingA->totalPrice());
    }

    /**
     * @test
     */
    public function priceShouldBeLowerWhenHavingADiscountWithCopyConstructor()
    {
        $bookingFromCarlosForListing1 = BookingBuilder::aBooking()
            ->withListing(
                ListingBuilder::aListing()
                    ->withId('1')
                    ->withLandlordId('xx')
                    ->withMonthlyPrice(100)
                    ->build()
            )
            ->withTenant(
                TenantBuilder::aTenant()
                    ->withFullName('Carlos Gallardo')
                    ->withPhoneNumber('620101010')
                    ->withEmail('test@gmail.com')
                    ->build()
            )
            ->withCheckIn(new \DateTimeImmutable('2018-05-01'))
            ->withCheckOut(new \DateTimeImmutable('2019-01-31'));

        $bookingA = $bookingFromCarlosForListing1->but()->withNoDiscount()->build();
        $bookingB = $bookingFromCarlosForListing1->but()->withDiscount(0.50)->build();

        $this->assertTrue($bookingB->totalPrice() < $bookingA->totalPrice());
    }

    /**
     * @test
     */
    public function priceShouldBeLowerWhenHavingADiscountCombiningBuilders()
    {
        $bookingA = BookingBuilder::aBooking()
            ->forListing(
                ListingBuilder::aListing()
                    ->withId('1')
                    ->withLandlordId('xx')
                    ->withMonthlyPrice(100)
            )
            ->fromTenant(
                TenantBuilder::aTenant()
                    ->withFullName('Carlos Gallardo')
                    ->withPhoneNumber('620101010')
                    ->withEmail('test@gmail.com')
            )
            ->withCheckIn(new \DateTimeImmutable('2018-05-01'))
            ->withCheckOut(new \DateTimeImmutable('2019-01-31'))
            ->withNoDiscount()
            ->build();

        $bookingB = BookingBuilder::aBooking()
            ->forListing(
                ListingBuilder::aListing()
                    ->withId('1')
                    ->withLandlordId('xx')
                    ->withMonthlyPrice(100)
            )
            ->fromTenant(
                TenantBuilder::aTenant()
                    ->withFullName('Carlos Gallardo')
                    ->withPhoneNumber('620101010')
                    ->withEmail('test@gmail.com')
            )
            ->withCheckIn(new \DateTimeImmutable('2018-05-01'))
            ->withCheckOut(new \DateTimeImmutable('2019-01-31'))
            ->withDiscount(0.50)
            ->build();

        $this->assertTrue($bookingB->totalPrice() < $bookingA->totalPrice());
    }

    /**
     * @test
     */
    public function priceShouldBeLowerWhenHavingADiscountWithFactories()
    {
        $bookingFromCarlosForListing1 =
            aBooking()
                ->from(
                    aTenant()->withFullName('Carlos Gallardo')->withPhoneNumber('620101010')->withEmail('test@gmail.com')
                )
                ->for(
                    aListing()->withId('1')->withLandlordId('xx')->withMonthlyPrice(100)
                )
                ->checkingInOn(new \DateTimeImmutable('2018-05-01'))
                ->checkingOutOn(new \DateTimeImmutable('2019-01-31'));

        $bookingA = $bookingFromCarlosForListing1->but()->withNoDiscount()->build();
        $bookingB = $bookingFromCarlosForListing1->but()->withDiscount(0.50)->build();

        $this->assertTrue($bookingB->totalPrice() < $bookingA->totalPrice());
    }
}

function aBooking(): BookingBuilder
{
    return BookingBuilder::aBooking();
}

function aListing(): ListingBuilder
{
    return ListingBuilder::aListing();
}

function aTenant(): TenantBuilder
{
    return TenantBuilder::aTenant();
}
