<?php

namespace App\Console\Commands;

use App\Services\ListingConversationService;
use Illuminate\Console\Command;

/**
 * Class DumpOldMeetingRequests
 * @package App\Console\Commands
 */
class DumpOldMeetingRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump:old_requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump Old Meeting Requests.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ids = [];
        $service = new ListingConversationService();
        foreach ($service->inactiveConversations() as $conversation) {
            if($conversation->created_at->diffInDays(now()) >= MAX_DAYS_FOR_DUMP_MEETING_REQUESTS) {
                array_push($ids, $conversation->id);
            }
        }

        return $service->archiveOldRequests($ids);
    }
}
