<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Treatment;
use App\Models\Appointment;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(){

        $accountantName = Auth::user()->name;


        //first section: Cards

        // Total Revenue This Week
        $weeklyRevenue = Invoice::whereBetween('paymentDate', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('totalbill');

        // Payments Received This Week
        $weeklyPayments = Invoice::where('paymentStatus', 'Paid')
            ->whereBetween('paymentDate', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('totalbill');

        // Unpaid Invoices (Count & Total)
        $unpaidInvoicesCount = Invoice::where('paymentStatus', 'Unpaid')
        ->whereBetween('paymentDate', [now()->startOfMonth(), now()->endOfMonth()])
        ->count();
        $unpaidInvoicesTotal = Invoice::where('paymentStatus', 'Unpaid')
        ->whereBetween('paymentDate', [now()->startOfMonth(), now()->endOfMonth()])
        ->sum('totalbill');

        // ---------- Top Treatment by Revenue card (single + percentage) ----------
        $totalRevenueThisMonth = (float) Invoice::whereBetween('paymentDate', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('totalbill');

        $topTreatmentRow = Treatment::select('treatments.treatment_type', DB::raw('SUM(invoices.totalbill) as total'))
            ->join('appointments', 'treatments.appointment_id', '=', 'appointments.id')
            ->join('invoices', 'appointments.id', '=', 'invoices.appointment_id')
            ->whereBetween('invoices.paymentDate', [now()->startOfMonth(), now()->endOfMonth()])
            ->groupBy('treatments.treatment_type')
            ->orderByDesc('total')
            ->first();

        if ($topTreatmentRow && $totalRevenueThisMonth > 0) {
            $topTreatment = [
                'treatment' => $topTreatmentRow->treatment_type,
                'percentage' => round(($topTreatmentRow->total / $totalRevenueThisMonth) * 100, 2),
            ];
        } else {
            $topTreatment = [
                'treatment' => 'No data',
                'percentage' => 0,
            ];
        }


        //secound section: tables

        // Invoice Table (The last three days)

        $recentInvoices = Invoice::whereDate('paymentDate', '<', now()->toDateString())
            ->whereDate('paymentDate', '>=', Carbon::now()->subDays(3)->toDateString())
            ->with(['appointment.patient', 'appointment.dentist'])
            ->latest()
            ->paginate(5, ['*'], 'invoices_page');


        // Top 5 Dentist Table - Based on Monthly Revenue

        // 1) appointment-level invoice sums for the month
        $invoicePerAppointment = Invoice::select('appointment_id', DB::raw('SUM(totalbill) as appointment_revenue'))
            ->whereBetween('paymentDate', [now()->startOfMonth(), now()->endOfMonth()])
            ->groupBy('appointment_id');

        // 2) treatment counts per appointment
        $treatmentCountPerAppointment = Treatment::select('appointment_id', DB::raw('COUNT(*) as treatment_count'))
            ->groupBy('appointment_id');

        //3) join subqueries to appointments and aggregate per dentist
        $topDoctorsQuery = Appointment::leftJoinSub($invoicePerAppointment, 'inv', function ($join) {
                $join->on('appointments.id', '=', 'inv.appointment_id');
            })
            ->leftJoinSub($treatmentCountPerAppointment, 'trs', function ($join) {
                $join->on('appointments.id', '=', 'trs.appointment_id');
            })
            ->leftJoin('users', 'appointments.dentist_id', '=', 'users.id')
            ->select(
                'appointments.dentist_id',
                'users.name as dentist_name',
                DB::raw('SUM(COALESCE(inv.appointment_revenue, 0)) as revenue'),
                DB::raw('SUM(COALESCE(trs.treatment_count, 0)) as treatments_count')
            )
            ->groupBy('appointments.dentist_id', 'users.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        //4) Map to desired output
        $topDoctors = $topDoctorsQuery->map(function ($item, $index) {
            $commissionRate = 0.40; // change if dynamic
            return [
                'rank' => $index + 1,
                'dentist_name' => $item->dentist_name ?? 'Unknown',
                'treatments' => (int) $item->treatments_count,
                'revenue' => (float) $item->revenue,
                'commission' => ($commissionRate * 100) . '%',
                'payout' => round((float) $item->revenue * $commissionRate, 2),
            ];
        });


        //Third section: Charts

        // Pie Chart - Revenue Distribution by Treatment Type(for Current Month)

        $revenueByTreatment = Treatment::select('treatments.treatment_type', DB::raw('SUM(invoices.totalbill) as total'))
            ->join('appointments', 'treatments.appointment_id', '=', 'appointments.id')
            ->join('invoices', 'appointments.id', '=', 'invoices.appointment_id')
            ->whereBetween('invoices.paymentDate', [now()->startOfMonth(), now()->endOfMonth()])
            ->groupBy('treatments.treatment_type')
            ->get();

            // Percentage calculation.
            $total = $revenueByTreatment->sum('total');
            $pieData = $revenueByTreatment->map(function ($item) use ($total) {
                return [
                    'label' => $item->treatment_type,
                    'percentage' => round(($item->total / $total) * 100, 2),
                ];
            });


        // Line Chart - Monthly Revenue (Current Year)

        $monthlyRevenue = Invoice::selectRaw('MONTH(paymentDate) as month, SUM(totalbill) as total')
            ->whereYear('paymentDate', now()->year)
            ->groupBy(DB::raw('MONTH(paymentDate)'))
            ->orderBy('month')
            ->get();

            // Convert numbers to month names

            $chartData = collect(range(1, 12))->map(function ($month) use ($monthlyRevenue) {
                $data = $monthlyRevenue->firstWhere('month', $month);
                return [
                    'month' => \Carbon\Carbon::create()->month($month)->format('F'),
                    'total' => $data ? $data->total : 0,
                ];
            });


        return view('dashboards.accountant', compact(
            'accountantName',
            'weeklyRevenue',
            'weeklyPayments',
            'unpaidInvoicesCount',
            'unpaidInvoicesTotal',
            'topTreatment',
            'recentInvoices',
            'topDoctors',
            'pieData',
            'chartData'
        ));
    }
}
