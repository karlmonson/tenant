<?php

namespace Karlmonson\Tenant\Console\Commands;

use Illuminate\Console\Command;
use Karlmonson\Tenant\Facades\Tenant;

class TenantGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:get {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the value of the specified Tenant key';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = $this->argument('key');
        $result = Tenant::getRow($key);
        if(null == $result) {
            $this->error('Key "' . $key . '" could not be found');
        } else {
            $headers = ['Key', 'Value', 'Encrypted', 'Env'];
            $this->table($headers, [[$key, $result->value, $result->is_encrypted ? 'Yes' : 'No', $result->is_env ? 'Yes' : 'No']]);
        }
    }
}