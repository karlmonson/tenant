<?php

namespace Karlmonson\Tenant\Console\Commands;

use Illuminate\Console\Command;

class TenantSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the Tenant database table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('db:seed', ['--class' => '\Karlmonson\Tenant\Database\Seeds\TenantTableSeeder']);
        $this->info('Tenant table seeded successfully!');
    }
}