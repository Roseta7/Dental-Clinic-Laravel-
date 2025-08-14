<?php

namespace App\Observers;

use App\Models\Treatment;
use App\Services\AuditLogService;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class TreatmentObserver
{

    protected AuditLogService $auditlog;

    public function __construct()
    {
        $this->auditlog = App::make(AuditLogService::class);
    }

    /**
     * Handle the Treatment "created" event.
     */
    public function created(Treatment $treatment): void
    {
        //
    }

    /**
     * Handle the Treatment "updated" event.
     */
    public function updated(Treatment $treatment): void
    {
        $original = $this->formatDates($treatment->getOriginal());
        $changes = $this->formatDates($treatment->getDirty());

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
            'treatments',
            $treatment->id,
            json_encode($diff, JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the Treatment "deleted" event.
     */
    public function deleted(Treatment $treatment): void
    {
        $oldData = $this->formatDates($treatment->getAttributes());

        $this->auditlog->log(
            auth()->id(),
            'Delete',
            'treatments',
            $treatment->id,
            json_encode(['old' => $oldData], JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the Treatment "restored" event.
     */
    public function restored(Treatment $treatment): void
    {
        //
    }

    /**
     * Handle the Treatment "force deleted" event.
     */
    public function forceDeleted(Treatment $treatment): void
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
