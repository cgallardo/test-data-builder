<?php

declare(strict_types=1);

namespace Bookings;

class Tenant
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

    public function __construct(string $fullName, string $phoneNumber, string $email)
    {
        $this->fullName    = $fullName;
        $this->phoneNumber = $phoneNumber;
        $this->email       = $email;
    }
}
