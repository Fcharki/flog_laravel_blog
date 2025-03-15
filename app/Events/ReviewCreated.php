<?php
namespace App\Events;

use App\Models\Review;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReviewCreated implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    public $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }
}