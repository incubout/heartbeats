<?php

namespace Incubout\Heartbeats\Console\Commands;

use Illuminate\Console\Command;

class SendHeartbeat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heartbeats:send {url : The url to ping} {--queue= : Whether the job should be queued}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a heartbeat';

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
        $url = $this->argument('url');
        $queue = $this->option('queue');

        // Validate url
        if (!preg_match('#^https?://(.*)$#', $url)) {
            return $this->error('Invalid url.');
        }

        if ($queue) {
            dispatch((new \Incubout\Heartbeats\Jobs\SendHeartbeat($url))->onQueue($queue));
            $this->info('Heartbeat to '.$url.' queued on '.$queue.'');
        } else {
            $this->info('Sending heartbeat to '.$url);
            dispatch(new \Incubout\Heartbeats\Jobs\SendHeartbeat($url));
        }
    }
}
