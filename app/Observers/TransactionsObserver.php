<?php

namespace App\Observers;

use App\Models\Transactions;
use App\Helpers\Services;

class TransactionsObserver
{
    /**
     * Handle the Transactions "created" event.
     */
    public function created(Transactions $transactions): void
    {
        // Budgeting::where('user_id', Auth::user()->id)->delete();

        Services::storeBudgeting(3);
        Services::storeBudgeting(4);

    }

    /**
     * Handle the Transactions "updated" event.
     */
    public function updated(Transactions $transactions): void
    {
        //
    }

    /**
     * Handle the Transactions "deleted" event.
     */
    public function deleted(Transactions $transactions): void
    {
        //
    }

    /**
     * Handle the Transactions "restored" event.
     */
    public function restored(Transactions $transactions): void
    {
        //
    }

    /**
     * Handle the Transactions "force deleted" event.
     */
    public function forceDeleted(Transactions $transactions): void
    {
        //
    }
}
