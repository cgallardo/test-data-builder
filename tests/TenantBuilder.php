<?php

declare(strict_types=1);

namespace BookingsTests;

use Bookings\Tenant;

class TenantBuilder
{
    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $email;

    public static function aTenant(): self
    {
        return new self;
    }

    public function withFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function withPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function withEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function build(): Tenant
    {
        return new Tenant(
            $this->fullName,
            $this->phoneNumber,
            $this->email
        );
    }
}
