<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ Stripe Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\StripeBundle\Syncer;

use SerendipityHQ\Bundle\StripeBundle\Model\StripeLocalResourceInterface;
use Stripe\ApiResource;

/**
 * An interface implemented by all Stripe Bundle model helpers.
 *
 * @author Adamo Crespi <hello@aerendir.me>
 */
interface SyncerInterface
{
    /**
     * Update a StripeLocalResourceObject given an ApiResource object.
     *
     * This method uses reflection to update the StripeLocalResourceObject's fields as the ApiResource may contain info
     * that have to be set in the object but that MUST not be settable the developer.
     *
     * For example, a Card object has the field cvc_check that has to be updatable from a \Stripe\Card but not using a
     * setter.
     */
    public function syncLocalFromStripe(StripeLocalResourceInterface $localResource, ApiResource $stripeResource): void;

    /**
     * Update a StripeLocalResourceObject given an ApiResource object.
     *
     * This method uses reflection to update the StripeLocalResourceObject's fields as the ApiResource may contain info
     * that have to be set in the object but that MUST not be settable the developer.
     *
     * For example, a Card object has the field cvc_check that has to be updatable from a \Stripe\Card but not using a
     * setter.
     */
    public function syncStripeFromLocal(ApiResource $stripeResource, StripeLocalResourceInterface $localResource): void;
}
