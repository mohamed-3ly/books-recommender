<?php

namespace App\Listeners;

use App\Events\UserReadBookEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookReadListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(UserReadBookEvent $event): void
    {
        $uniqueValues = [];
        $book_read_log = $event->book->BooksReadLog;
        foreach ($book_read_log as $read) {
            for ($i = $read->start_page; $i <= $read->end_page; $i++) {
                $uniqueValues[$i] = true;
            }
        }
        $event->book->update(['read' => count($uniqueValues)]);
        cache()->forget('most-read-5-books');
    }
}
