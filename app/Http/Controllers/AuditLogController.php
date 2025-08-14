<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AuditLog::class, 'audit_log');
    }

    public function index()
    {
        $logs = AuditLog::with('user')
            ->latest()
            ->get();

        return view('auditlog.index', compact('logs'));
    }

    public function show(AuditLog $audit_log)
    {
        return view('auditlog.show', compact('audit_log'));
    }
}
