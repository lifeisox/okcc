<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SystemLog
{
    /**
     * Create a log message for updated fields
     * @param array $origin a record before updated
     * @param array $updated a record after updated
     * @param array $except The fields in $except array will be excluded from comparision.
     */
    public static function createLogForUpdate($table, $id, $origin, $updated, $except) {
        $message = '';
        foreach ($updated as $key => $value) {
            if ( !isset($except) || (isset($except) && !in_array($key, $except))) {
                if ($value <> $origin[$key]) { 
                    $message .= '(' . $key . ') ' . $origin[$key] . ' > ' . $value . ', ';
                }
            }
        }
        SystemLog::write("UPDATE", $table . ' [ID] ' . $id . ' [DETAIL] ' . $message);
    }
    
    /**
     * Create a log message for delete record
     * @param array $origin a record before deleted
     */
    public static function createLogForDelete($table, $origin) {
        SystemLog::write("DELETE", $table . ' [DETAIL] ' . $origin);
    }

    /**
     * Create a log message for insert record
     * @param array $origin a record before deleted
     */
    public static function createLogForInsert($table, $origin) {
        SystemLog::write("INSERT", $table . ' [DETAIL] ' . $origin);
    }

    /**
     * Write a Log message to system_logs table
     * @param text $status It says what action will happen
     * @param text $memo It says log messages.
     */
    private static function write($status, $memo) {
        $message = $status . " " . $memo;
        Log::info( $message );
    }

}
