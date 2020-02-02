<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\User;

use Symfony\Contracts\EventDispatcher\Event;

final class UserRegisteredEvent extends Event
{
    private $eventUser;

    public function __construct(User $user = null)
    {
        $this->eventUser = $user;
    }

    public function getUser(): ?User
    {
        return $this->eventUser;
    }
}