<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total products count
        $totalProducts = Product::count();
        
        // Get total categories count (distinct categories)
        $totalCategories = Product::distinct('category')->count();
        
        // Get total sales amount
        $totalSales = Sale::sum('total_price');
        
        // Get low stock products count (where total_quantity <= min_stock)
        $lowStockCount = Product::whereColumn('total_quantity', '<=', 'min_stock')
            ->whereNotNull('min_stock')
            ->count();
        
        // Get recent activities (last 10 activities)
        $recentActivities = $this->getRecentActivities();
        
        // Additional dashboard stats
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'delivered')->count();
        $totalCustomers = Order::distinct('customer_id')->count();
        
        // Recent sales (last 5)
        $recentSales = Sale::with('product')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Top selling products
        $topProducts = DB::table('sales')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
        
        // Low stock products details
        $lowStockProducts = Product::whereColumn('total_quantity', '<=', 'min_stock')
            ->whereNotNull('min_stock')
            ->orderBy('total_quantity', 'asc')
            ->limit(10)
            ->get();
        
        // Monthly sales trend (last 6 months)
        $monthlySales = DB::table('sales')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        
        return view('dashboard.admin', compact(
            'totalProducts',
            'totalCategories', 
            'totalSales',
            'lowStockCount',
            'recentActivities',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalCustomers',
            'recentSales',
            'topProducts',
            'lowStockProducts',
            'monthlySales'
        ));
    }
    
    private function getRecentActivities()
    {
        $activities = collect();
        
        // Recent products added (last 5)
        $recentProducts = Product::orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($product) {
                return [
                    'type' => 'product_added',
                    'message' => "New product \"{$product->name}\" added",
                    'time' => $product->created_at,
                    'icon' => '🔵'
                ];
            });
        
        // Recent sales (last 5)
        $recentSales = Sale::orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($sale) {
                $productName = $this->getProductName($sale->product_id);
                return [
                    'type' => 'sale',
                    'message' => "Sold {$sale->quantity} units of {$productName}",
                    'time' => $sale->created_at,
                    'icon' => '🟣'
                ];
            });
        
        // Recent orders (last 5)
        $recentOrders = Order::orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($order) {
                return [
                    'type' => 'order',
                    'message' => "New order from {$order->customer_name} - \${$order->total_amount}",
                    'time' => $order->created_at,
                    'icon' => '🟢'
                ];
            });
        
        // Low stock alerts (products with stock <= min_stock)
        $lowStockAlerts = Product::whereColumn('total_quantity', '<=', 'min_stock')
            ->whereNotNull('min_stock')
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($product) {
                return [
                    'type' => 'low_stock',
                    'message' => "Low stock alert: {$product->name} ({$product->total_quantity} remaining)",
                    'time' => $product->updated_at,
                    'icon' => '🟠'
                ];
            });
        
        // Combine all activities
        $activities = $activities
            ->merge($recentProducts)
            ->merge($recentSales)
            ->merge($recentOrders)
            ->merge($lowStockAlerts)
            ->sortByDesc('time')
            ->take(10);
        
        return $activities;
    }
    
    private function getProductName($productId)
    {
        $product = Product::find($productId);
        return $product ? $product->name : 'Unknown Product';
    }
}