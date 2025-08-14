<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Services\AuditLogService;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class InvoiceObserver
{

    protected AuditLogService $auditlog;

    public function __construct()
    {
        $this->auditlog = App::make(AuditLogService::class);
    }

    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        $original = $this->formatDates($invoice->getOriginal());
        $changes = $this->formatDates($invoice->getDirty());

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
            'invoices',
            $invoice->id,
            json_encode($diff, JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        $oldData = $this->formatDates($invoice->getAttributes());

        $this->auditlog->log(
            auth()->id(),
            'Delete',
            'invoices',
            $invoice->id,
            json_encode(['old' => $oldData], JSON_PRETTY_PRINT),
            now(),
        );
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
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
