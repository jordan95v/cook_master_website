<?php

namespace App\Console\Commands;

use App\Mail\RemindEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EventEmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:event-email-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remember the user that the event is coming up';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::where("date", Carbon::now()->format("Y-m-d"))->get();
        foreach ($events as $event) {
            $event_start = Carbon::createFromFormat('Y-m-d H:i:s', $event->date . ' ' . $event->start_time);
            $time_limit = Carbon::createFromFormat('Y-m-d H:i:s', $event->date . ' ' . $event->start_time)->subMinutes(30);
            if (Carbon::now()->between($event_start, $time_limit)) {
                Mail::to($event->participants)->queue(new RemindEvent($event));
            };
        }
    }
}
