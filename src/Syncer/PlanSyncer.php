<?php

/*
 * This file is part of the Serendipity HQ Stripe Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\StripeBundle\Syncer;

use SerendipityHQ\Bundle\StripeBundle\Model\StripeLocalPlan;
use SerendipityHQ\Bundle\StripeBundle\Model\StripeLocalResourceInterface;
use SerendipityHQ\Component\ValueObjects\Money\Money;
use Stripe\ApiResource;
use Stripe\Plan;

/**
 * @see https://stripe.com/docs/api#plan_object
 */
final class PlanSyncer extends AbstractSyncer
{
    /**
     * {@inheritdoc}
     */
    public function syncLocalFromStripe(StripeLocalResourceInterface $localResource, ApiResource $stripeResource): void
    {
        /** @var StripeLocalPlan $localResource */
        if ( ! $localResource instanceof StripeLocalPlan) {
            throw new \InvalidArgumentException('PlanSyncer::syncLocalFromStripe() accepts only StripeLocalPlan objects as first parameter.');
        }

        /** @var Plan $stripeResource */
        if ( ! $stripeResource instanceof Plan) {
            throw new \InvalidArgumentException('PlanSyncer::syncLocalFromStripe() accepts only Stripe\Plan objects as second parameter.');
        }

        $reflect = new \ReflectionClass($localResource);

        foreach ($reflect->getProperties() as $reflectedProperty) {
            // Set the property as accessible
            $reflectedProperty->setAccessible(true);

            // Guess the kind and set its value
            switch ($reflectedProperty->getName()) {
                case 'id':
                    $reflectedProperty->setValue($localResource, $stripeResource->id);
                    break;

                case 'object':
                    $reflectedProperty->setValue($localResource, $stripeResource->object);
                    break;

                case 'amount':
                    $reflectedProperty->setValue($localResource, new Money(['amount' => $stripeResource->amount, 'currency' => $stripeResource->currency]));
                    break;

                case 'created':
                    $created = new \DateTime();
                    $reflectedProperty->setValue($localResource, $created->setTimestamp($stripeResource->created));
                    break;

                case 'interval':
                    $reflectedProperty->setValue($localResource, $stripeResource->interval);
                    break;

                case 'intervalCount':
                    $reflectedProperty->setValue($localResource, $stripeResource->intervalCount);
                    break;

                case 'livemode':
                    $reflectedProperty->setValue($localResource, $stripeResource->livemode);
                    break;

                case 'metadata':
                    $reflectedProperty->setValue($localResource, $stripeResource->metadata);
                    break;

                case 'name':
                    $reflectedProperty->setValue($localResource, $stripeResource->name);
                    break;

                case 'statementDescriptor':
                    $reflectedProperty->setValue($localResource, $stripeResource->statementDescriptor);
                    break;

                case 'trialPeriodDays':
                    $reflectedProperty->setValue($localResource, $stripeResource->trialPeriodDays);
                    break;
            }
        }

        // Ever first persist the $localStripeResource: descendant syncers may require the object is known by the EntityManager.
        $this->getEntityManager()->persist($localResource);

        $this->getEntityManager()->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function syncStripeFromLocal(ApiResource $stripeResource, StripeLocalResourceInterface $localResource): void
    {
        /** @var Plan $stripeResource */
        if ( ! $stripeResource instanceof Plan) {
            throw new \InvalidArgumentException('PlanSyncer::hydrateStripe() accepts only Stripe\Plan objects as first parameter.');
        }

        /** @var StripeLocalPlan $localResource */
        if ( ! $localResource instanceof StripeLocalPlan) {
            throw new \InvalidArgumentException('PlanSyncer::hydrateStripe() accepts only StripeLocalPlan objects as second parameter.');
        }

        $this->getEntityManager()->persist($localResource);
        $this->getEntityManager()->flush();
    }

    public function syncLocalSources(StripeLocalResourceInterface $localResource, ApiResource $stripeResource): void
    {
        /** @var StripeLocalPlan $localResource */
        if ( ! $localResource instanceof StripeLocalPlan) {
            throw new \InvalidArgumentException('PlanSyncer::syncLocalFromStripe() accepts only StripeLocalPlan objects as first parameter.');
        }

        /** @var Plan $stripeResource */
        if ( ! $stripeResource instanceof Plan) {
            throw new \InvalidArgumentException('PlanSyncer::syncLocalFromStripe() accepts only Stripe\Plan objects as second parameter.');
        }

        $this->getEntityManager()->persist($localResource);
        $this->getEntityManager()->flush();
    }
}
