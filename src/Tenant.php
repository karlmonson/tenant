<?php

namespace Karlmonson\Tenant;

use Illuminate\Support\Facades\DB;

class Tenant
{
    /**
     * Get all of the Tenant settings.
     *
     * @return null|array
     */
    public static function all()
    {
        $result = DB::select('select name, value, is_encrypted, is_env from tenant');

        if (null == $result) return null;

        return $result;
    }

    /**
     * Get the value of the given key.
     *
     * @param string $key
     * @param string $default
     * @return null|string
     */
    public static function get($key, $default = null)
    {
        $result = DB::select('select value, is_encrypted, is_env from tenant where name = ?', [$key]);

        if (null == $result) return $default;

        if ($result[0]->is_encrypted && null !== $result[0]->value) {
            return decrypt($result[0]->value);
        } else {
            return $result[0]->value;
        }
    }

    /**
     * Get the row of the given key.
     *
     * @param string $key
     * @return null|string
     */
    public static function getRow($key)
    {
        $result = DB::select('select value, is_encrypted, is_env from tenant where name = ?', [$key]);

        if (null == $result) return null;

        if ($result[0]->is_encrypted && null !== $result[0]->value) {
            $result[0]->value = decrypt($result[0]->value);
        }

        return $result[0];
    }

    /**
     * Set the value of the given key.
     *
     * @param string $key
     * @param string $value
     * @param bool $encrypted
     * @return void
     */
    public static function set($key, $value, $encrypted = false, $env = false)
    {
        $search = DB::select('select value, is_encrypted from tenant where name = ?', [$key]);

        $value = $encrypted ? encrypt($value) : $value;

        if (null == $search) {
            DB::insert('insert into tenant (name, value, is_encrypted, is_env) values (?, ?, ?, ?)', [$key, $value, $encrypted, $env]);
        } else {
            DB::update('update tenant set value = ?, is_encrypted = ?, is_env = ? where name = ?', [$value, $encrypted, $env, $key]);
        }
    }

    /**
     * Swap the Tenant values in the app config.
     *
     * @return void
     */
    public static function swapConfig()
    {
        collect(self::all())->filter(function($config) {
            return $config->is_env;
        })->each(function($config) {
            $key = explode('_', $config->name);
            Config()->set(strtolower($key[0]).'.'.strtolower($key[1]), $config->is_encrypted ? decrypt($config->value) : $config->value);
        });
    }
}