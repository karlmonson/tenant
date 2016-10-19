<?php

namespace Karlmonson\Tenant\Console\Commands;

use Illuminate\Console\Command;
use Karlmonson\Tenant\Facades\Tenant;

class TenantSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:set {key} {value} {--encrypt=0} {--environment=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the value of the specified Tenant key';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = $this->argument('key');
        $value = $this->argument('value');
        $encrypt = $this->option('encrypt');
        $env = $this->option('environment');

        Tenant::set($key, $value, $encrypt, $env);

        $this->info($key . ' has been set successfully!');
    }
}