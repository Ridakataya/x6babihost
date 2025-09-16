<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Availability;



class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): never
    {
        // Your command logic here
        //$availabilities = Availability::where('is_available', 1)->get();
        //$this->info('availabilities: ');

       // dd(vars: $availabilities->toArray());

       $availabilities = Availability::all();
       $this->info('availabilities: ');
         dd(vars: $availabilities);
    }
}
