<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\ConferenceRepository;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private ConferenceRepository $conferenceRepository;

    public function __construct(Environment $twig, ConferenceRepository $conferenceRepository)
    {
        $this->twig = $twig;
        $this->conferenceRepository = $conferenceRepository;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('conferences', $this->conferenceRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
