<?php

namespace App\Observers;

use App\Models\Patient;
use App\Services\AuditLogService;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class PatientObserver
{
    protected AuditLogService $auditlog;

    public function __construct()
    {
        $this->auditlog = App::make(AuditLogService::class);
    }

    /**
     * Handle the Patient "created" event.
     */
    public function created(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "updated" event.
     */
    public function updated(Patient $patient): void
    {
        $original = $this->formatDates($patient->getOriginal());
        $changes = $this->formatDates($patient->getDirty());

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
            'patients',
            $patient->id,
            json_encode($diff, JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the Patient "deleted" event.
     */
    public function deleted(Patient $patient): void
    {
        $oldData = $this->formatDates($patient->getAttributes());

        $this->auditlog->log(
            auth()->id(),
            'Delete',
            'patients',
            $patient->id,
            json_encode(['old' => $oldData], JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the Patient "restored" event.
     */
    public function restored(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     */
    public function forceDeleted(Patient $patient): void
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
