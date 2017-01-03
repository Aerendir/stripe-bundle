<?php

namespace SerendipityHQ\Bundle\StripeBundle\EventListener;

use SerendipityHQ\Bundle\StripeBundle\Event\StripeSubscriptionCreateEvent;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Manages Subscriptions on Stripe.
 */
class StripeSubscriptionSubscriber extends AbstractStripeSubscriber
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            StripeSubscriptionCreateEvent::CREATE => 'onSubscriptionCreate'
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param StripeSubscriptionCreateEvent $event
     * @param $eventName
     * @param ContainerAwareEventDispatcher|EventDispatcherInterface $dispatcher
     */
    public function onSubscriptionCreate(StripeSubscriptionCreateEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        $localSubscription = $event->getLocalSubscription();

        $result = $this->getStripeManager()->createSubscription($localSubscription);

        // Check if something went wrong
        if (false === $result) {
            // Stop progation
            $event->stopPropagation();

            // Dispatch a failed event
            $dispatcher->dispatch(StripeSubscriptionCreateEvent::FAILED, $event);

            // exit
            return;
        }

        $dispatcher->dispatch(StripeSubscriptionCreateEvent::CREATED, $event);
    }

}