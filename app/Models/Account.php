<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Account extends Model
{
    use Billable, HasFactory;

    public function subscribedToAnyOfPrices()
    {
        if ($this->isSubscribedToPrice(env('STRIPE_STARTER_PLAN_PRICE_ID'))) {
            return true;
        }

        if ($this->isSubscribedToPrice(env('STRIPE_PRO_PLAN_PRICE_ID'))) {
            return true;
        }

        return false;
    }

    public function subscribedToWhatPrice()
    {
        if ($this->isSubscribedToPrice(env('STRIPE_STARTER_PLAN_PRICE_ID'))) {
            return 'Starter Plan';
        }

        if ($this->isSubscribedToPrice(env('STRIPE_PRO_PLAN_PRICE_ID'))) {
            return 'Pro Plan';
        }

        return 'Free Plan';
    }

    public function isSubscribedToPrice($price)
    {
        if ($this->isSpecialAccount() && $price == env('STRIPE_PRO_PLAN_PRICE_ID')) {
            return true;
        }

        if (empty($this->stripe_id)) {
            return false;
        }

        return $this->subscribedToPrice($price);
    }

    public function isSpecialAccount()
    {
        $emails = ['david+nextstep@dbtechreviews.com', 'demo@nextstep.management', 'demo@marmotte.io', 'demo@example-app.test'];
        $existingEmails = User::whereIn('email', $emails)->pluck('email')->toArray();

        return ! empty($existingEmails);
    }
}
