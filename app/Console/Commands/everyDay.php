<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\stallowner;
class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will delete expired stallowner';

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
        DB::table('stallowners')->where('expiration_date',date('Y-m-d'))->delete();
        // Storage::delete($old_profile_image);
    }
}
