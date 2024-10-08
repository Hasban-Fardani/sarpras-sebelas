<?php

namespace App\Observers;

use App\Models\SubmissionItem;

class SubmissionItemObserver
{
    /**
     * Handle the SubmissionItem "created" event.
     */
    public function created(SubmissionItem $submissionItem): void
    {
        //
    }

    /**
     * Handle the SubmissionItem "updated" event.
     */
    public function updated(SubmissionItem $submissionItem): void
    {
        //
    }

    /**
     * Handle the SubmissionItem "deleted" event.
     */
    public function deleted(SubmissionItem $submissionItem): void
    {
        //
    }

    /**
     * Handle the SubmissionItem "restored" event.
     */
    public function restored(SubmissionItem $submissionItem): void
    {
        //
    }

    /**
     * Handle the SubmissionItem "force deleted" event.
     */
    public function forceDeleted(SubmissionItem $submissionItem): void
    {
        //
    }
}
