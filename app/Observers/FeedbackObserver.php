<?php

namespace App\Observers;

use App\Models\Feedback;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     */
    public function created(Feedback $feedback): void
    {
        $this->calculateVendorRating($feedback);
    }

    /**
     * Handle the Feedback "updated" event.
     */
    public function updated(Feedback $feedback): void
    {
        $this->calculateVendorRating($feedback);
    }

    /**
     * Handle the Feedback "deleted" event.
     */
    public function deleted(Feedback $feedback): void
    {
        $this->calculateVendorRating($feedback);
    }

    /**
     * Calculate total rating
     */
    private function calculateVendorRating(Feedback $feedback): void
    {
        $currentRating = ($feedback->service_rating + $feedback->delivery_rating) / 2;

        $feedback->vendor->updateQuietly([
            'rating' => ($currentRating + $feedback->vendor->rating) / 2,
        ]);
    }
}
