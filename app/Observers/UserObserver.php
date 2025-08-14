<?php

namespace App\Observers;

use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class UserObserver
{

    protected AuditLogService $auditlog;

    public function __construct()
    {
        $this->auditlog = App::make(AuditLogService::class);
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $original = $this->formatDates($user->getOriginal());
        $changes = $this->formatDates($user->getDirty());

        $diff = [
            'old' => [],
            'new' => [],
        ];

        foreach ($changes as $key => $newValue) {
            $diff['old'][$key] = $original[$key] ?? null;
            $diff['new'][$key] = $newValue;
        }

        $this->auditlog->log(
            auth()->id(),
            'Update',
            'users',
            $user->id,
            json_encode($diff, JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $oldData = $this->formatDates($user->getAttributes());

        $this->auditlog->log(
            auth()->id(),
            'Delete',
            'users',
            $user->id,
            json_encode(['old' => $oldData], JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }

    /**
     * Format all Carbon/DateTime instances into a clean string.
     */
    private function formatDates(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($value instanceof Carbon) {
                $data[$key] = $value->format('Y-m-d H:i:s');
            }
        }
        return $data;
    }
}
