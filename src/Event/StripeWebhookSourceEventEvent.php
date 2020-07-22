<?php

/*
 * This file is part of the Serendipity HQ Stripe Bundle.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\StripeBundle\Event;

/**
 * Dispatched when a source.* event has been received by the webhook endpoint.
 *
 * @author Adamo Crespi <hello@aerendir.me>
 */
class StripeWebhookSourceEventEvent extends AbstractStripeWebhookEventEvent
{
    /**
     * Occurs whenever an source is canceled.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-source.canceled
     */
    const CANCELED = 'stripe.webhook.source.canceled';

    /**
     * Occurs whenever an source transition to chargeable.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-source.chargeable
     */
    const CHARGEABLE = 'stripe.webhook.source.chargeable';

    /**
     * Occurs whenever an source is failed.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-source.failed
     */
    const FAILED = 'stripe.webhook.source.failed';
}
