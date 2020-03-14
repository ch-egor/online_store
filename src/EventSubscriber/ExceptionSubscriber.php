<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class ExceptionSubscriber implements EventSubscriberInterface
{
    /** @var Environment */
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['runVueApp', 0],
            ],
        ];
    }

    public function runVueApp(ExceptionEvent $event)
    {
        if (preg_match('/^\/api\//', $event->getRequest()->getPathInfo())) {
            return;
        }

        if ($event->getThrowable() instanceof NotFoundHttpException) {
            $event->allowCustomResponseCode();

            $response = new Response();
            $response->setContent($this->twig->render('vue_app.html.twig'));

            $event->setResponse($response);
        }
    }
}