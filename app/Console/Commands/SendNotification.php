<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Notification;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifyController;
use App\User;
class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:sendnotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Will Get Notification Every Minutes';

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
     * @return int
     */
    public function handle()
    {
        User::find(8)->update(['name' => random_int(0,10)]);
        $this->info('User Send Successfully');
    }
}
