<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LiveStream;
class UpdateLiveStreamStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-live-stream-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of completed live streams';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();

        LiveStream::where('scheduled_end', '<=', $now)
            ->where('status', 'scheduled')
            ->update(['status' => 'completed']);

        $this->info('Live stream statuses updated.');
    }
}
