<?php

namespace Karlmonson\Tenant\Console\Commands;

use Illuminate\Console\Command;
use Karlmonson\Tenant\Facades\Tenant;

class TenantList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all the Tenant keys with their values';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $result = collect(Tenant::all())->map(function($item, $key) {
            return [$item->name, $item->is_encrypted && null !== $item->value ? decrypt($item->value) : $item->value, $item->is_encrypted ? 'Yes' : 'No', $item->is_env ? 'Yes' : 'No'];
        });
        if(null == $result) {
            $this->error('No Tenant keys could be found');
        } else {
            $headers = ['Key', 'Value', 'Encrypted', 'Env'];
            $this->table($headers, $result);
        }
    }
}