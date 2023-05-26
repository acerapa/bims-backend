<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetMemoryLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:setmemorylimit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \App\Http\Controllers\plugin_project_config\MemoryLimit::set();
    }
}
