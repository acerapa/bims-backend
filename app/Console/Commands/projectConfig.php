<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * TEST SEND 3
 */

class projectConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:switch {project}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Switch project environment';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $project = $this->argument('project');

        if($project == 'editor') {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("local");
        }
        else if($project == 'deanlief') {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("deanleifproperties.com");
        }
        else if($project == 'mcrich') {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("mcrichtravel.com");
        }
        else if($project == 'foxcity') {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("foxcityph.tech");
        }
        else if($project == 'cims') {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("cims.com");
        }
        else if($project == 'multistoreapp') {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("multistoreapp.tech");
        }
        else {
            \App\Http\Controllers\plugin_project_config\Environment::setProjectEnv("local");
        }
    }
}
