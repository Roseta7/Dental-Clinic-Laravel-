<?php

namespace App\Observers;

use App\Models\MedicalHistory;
use App\Services\AuditLogService;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class MedicalHistoryObserver
{

    protected AuditLogService $auditlog;

    public function __construct()
    {
        $this->auditlog = App::make(AuditLogService::class);
    }

    /**
     * Handle the MedicalHistory "created" event.
     */
    public function created(MedicalHistory $medicalHistory): void
    {
        //
    }

    /**
     * Handle the MedicalHistory "updated" event.
     */
    public function updated(MedicalHistory $medicalHistory): void
    {
        $original = $this->formatDates($medicalHistory->getOriginal());
        $changes = $this->formatDates($medicalHistory->getDirty());

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
            'medical_histories',
            $medicalHistory->id,
            json_encode($diff, JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the MedicalHistory "deleted" event.
     */
    public function deleted(MedicalHistory $medicalHistory): void
    {
        $oldData = $this->formatDates($medicalHistory->getAttributes());

        $this->auditlog->log(
            auth()->id(),
            'Delete',
            'medical_histories',
            $medicalHistory->id,
            json_encode(['old' => $oldData], JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the MedicalHistory "restored" event.
     */
    public function restored(MedicalHistory $medicalHistory): void
    {
        //
    }

    /**
     * Handle the MedicalHistory "force deleted" event.
     */
    public function forceDeleted(MedicalHistory $medicalHistory): void
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
