<?php

namespace Karlmonson\Tenant\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tenant')->insert([
            'name' => 'BROADCAST_DRIVER',
            'value' => 'log',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'CACHE_DRIVER',
            'value' => 'file',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'SESSION_DRIVER',
            'value' => 'file',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'QUEUE_DRIVER',
            'value' => 'sync',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'REDIS_HOST',
            'value' => '127.0.0.1',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'REDIS_PASSWORD',
            'value' => null,
            'is_encrypted' => true,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'REDIS_PORT',
            'value' => '6379',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'MAIL_DRIVER',
            'value' => 'smtp',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'MAIL_HOST',
            'value' => 'mailtrap.io',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'MAIL_PORT',
            'value' => '2525',
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'MAIL_USERNAME',
            'value' => null,
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'MAIL_PASSWORD',
            'value' => null,
            'is_encrypted' => true,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'MAIL_ENCRYPTION',
            'value' => null,
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'PUSHER_APP_ID',
            'value' => null,
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'PUSHER_KEY',
            'value' => null,
            'is_encrypted' => false,
            'is_env' => true
        ]);

        DB::table('tenant')->insert([
            'name' => 'PUSHER_SECRET',
            'value' => null,
            'is_encrypted' => true,
            'is_env' => true
        ]);
    }
}