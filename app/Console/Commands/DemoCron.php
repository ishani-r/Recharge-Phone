<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AutoSendMail;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $User = User::all();
        // \Log::info($User);
        foreach ($User as $all) {

            Mail::to($all['email'])->send(new AutoSendMail());
            // Mail::raw("This is automatically generated mail", function ($message) use ($all) {
            //     $message->from('ranpariyaishani21@gmail.com');
            //     $message->to($all->email)->subject('Cron Job');
            // });
        }
        // return Command::SUCCESS;
    }
}
