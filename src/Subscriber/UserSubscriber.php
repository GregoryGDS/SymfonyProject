<?php

declare(strict_types=1);

use App\Event\UserRegisteredEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Psr\Log\LoggerInterface;

final class EventSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [UserRegisteredEvent::class => 'onUserRegisteredEvent'];
    }

    public function onUserRegisteredEvent(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        if($user){
            $this->logger->info(sprintf(
                'Utilisateur créé avec : email %s, firstName %s and lastName %s',
                $user->getEmail(),
                $user->getFirstName(),
                $user->getLastName()
        ));
        }

    }

}
