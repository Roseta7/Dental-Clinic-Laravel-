<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Carbon;

class AuditLogService
{
    public function log(int $userId, string $actionType, string $tableName, int $recordId, string $details, Carbon $actionTime): void
    {
        try {
            AuditLog::create([
                'user_id' => $userId,
                'action_type' => $actionType,
                'table_name' => $tableName,
                'record_id' => $recordId,
                'action_details' => $details,
                'action_time' => $actionTime,
            ]);
        } catch (\Throwable $th) {
            \Log::error('AuditLog error: ' . $th->getMessage());
        }
        
    }
}