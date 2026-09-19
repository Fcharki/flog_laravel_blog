<?php

namespace App\Events;

use App\Models\Review;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewCreated implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}
