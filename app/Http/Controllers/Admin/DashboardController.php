<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $adminName = Auth::user()->name;


        $patientsCount = Patient::count();
        $treatmentsCount = Treatment::count();
        $paidInvoicesCount = Invoice::where('paymentStatus', 'Paid')->count();
        $unpaidInvoicesCount = Invoice::where('paymentStatus', 'Unpaid')->count();


        $months = collect(range(3, 0))->map(function($i) {
            return now()->subMonths($i)->format('Y-m');
        });


        $patientsTrend = [];
        $unpaidTrend = [];
        $paidTrend = [];
        $treatmentsTrend = [];

        foreach ($months as $month) {
            [$y, $m] = explode('-', $month);

            $patientsTrend[] = Patient::whereYear('created_at', $y)->whereMonth('created_at', $m)->count();
            $unpaidTrend[] = Invoice::where('paymentStatus', 'Unpaid')->whereYear('created_at', $y)->whereMonth('created_at', $m)->count();
            $paidTrend[] = Invoice::where('paymentStatus', 'Paid')->whereYear('created_at', $y)->whereMonth('created_at', $m)->count();
            $treatmentsTrend[] = Treatment::whereYear('created_at', $y)->whereMonth('created_at', $m)->count();
        }


        $chartTrends = [
            'patientsTrend' => $patientsTrend,
            'unpaidTrend' => $unpaidTrend,
            'paidTrend' => $paidTrend,
            'treatmentsTrend' => $treatmentsTrend
        ];


        $invoicesByMonth = Invoice::selectRaw('MONTH(paymentDate) as month, SUM(totalbill) as total')
            ->whereYear('paymentDate', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // تحويل الناتج لـ 12 شهرًا (حتى لو لم يوجد بيانات في بعض الشهور)
        $monthlyTotals = array_fill(0, 12, 0);
        
        foreach ($invoicesByMonth as $month => $total) {
            $monthlyTotals[$month - 1] = $total;
        }

        // ✅ 4. آخر 5 سجلات من AuditLogs
        $latestAuditLogs = AuditLog::latest()->take(5)->get();

        return view('dashboards.admin', compact(
            'adminName',
            'patientsCount',
            'treatmentsCount',
            'paidInvoicesCount',
            'unpaidInvoicesCount',
            'monthlyTotals',
            'latestAuditLogs',
            'chartTrends',
        ));
    }
}
