<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $productCount = Product::count();
        $orderCount = Order::count();
        $revenue = Order::where('status', '!=', 'canceled')->sum('total_amount');


        return view('Admin.dashboard', compact('productCount', 'orderCount', 'revenue'));
    }

    public function salesReport(Request $request)
    {
        $query = Order::query();
        $period = $request->get('period', 'all');
      
$date = $request->get('date', now()->format('Y-m-d'));
        switch ($period) {
            case 'daily':
                $query->whereDate('created_at', $date);
                $title = "Daily report Sales(" . Carbon::parse($date)->format('d M Y') . ")";
                break;
            case 'weekly':
                $startOfWeek = Carbon::parse($date)->startOfWeek();
                $endOfWeek = Carbon::parse($date)->endOfWeek();
                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                $title = "Weekly Sales Report (" . $startOfWeek->format('d M Y') . " - " . $endOfWeek->format('d M Y') . ")";
                break;
            case 'monthly':
                $query->whereMonth('created_at', Carbon::parse($date)->month)
                    ->whereYear('created_at', Carbon::parse($date)->year);

                $title = "monthly Sales Report (" . Carbon::parse($date)->format('F Y') . ")";
                break;
            default:

                $title = "All Time Sales Report";
                break;
        }
        $Orders = $query->orderBy('created_at', 'desc')->get();
        $totalOrders = $Orders->count();
        $totalRevenue = $Orders->where('status', '!=', 'canceled')->sum('total_amount');
        $successfulOrders = $Orders->where('status', 'completed')->count();
        return view('Admin.Sales.index', compact(
            'Orders',
            'totalOrders',
            'totalRevenue',
             'successfulOrders',
             'period',
             'date',
             'title',
            ));

    }
}
