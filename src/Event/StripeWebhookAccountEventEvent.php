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

namespace SerendipityHQ\Bundle\StripeBundle\Event;

/**
 * Dispatched when an account.* event has been received by the webhook endpoint.
 *
 * @author Adamo Crespi <hello@aerendir.me>
 */
final class StripeWebhookAccountEventEvent extends AbstractStripeWebhookEventEvent
{
    /**
     * Occurs whenever an account status or property has changed.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-account.updated
     */
    const UPDATED = 'stripe.webhook.account.updated';

    /**
     * Occurs whenever a user deauthorizes an application. Sent to the related application only.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-account.application.deauthorized
     */
    const APPLICATION_DEAUTHORIZED = 'stripe.webhook.account.application.deauthorized';

    /**
     * Occurs whenever an external account is created.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-account.external_account.created
     */
    const EXTERNAL_ACCOUNT_CREATED = 'stripe.webhook.account.external_account.created';

    /**
     * Occurs whenever an external account is deleted.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-account.external_account.deleted
     */
    const EXTERNAL_ACCOUNT_DELETED = 'stripe.webhook.account.external_account.deleted';

    /**
     * Occurs whenever an external account is updated.
     *
     * @var string
     *
     * @see https://stripe.com/docs/api#event_types-account.external_account.updated
     */
    const EXTERNAL_ACCOUNT_UPDATED = 'stripe.webhook.account.external_account.updated';
}
