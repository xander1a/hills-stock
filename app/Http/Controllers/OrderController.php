<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['orderItems.product']);
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'like', '%' . $request->search . '%')
                  ->orWhere('id', 'like', '%' . $request->search . '%');
            });
        }
        
        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Date range filter
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Get status options for filter
        $statusOptions = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled'
        ];
        
        return view('orders.index', compact('orders', 'statusOptions'));
    }
    
    public function show($id)
    {
        $order = Order::with(['orderItems.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }
    
   public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
    ]);
    
    $order = Order::findOrFail($id);
    $oldStatus = $order->status;
    $newStatus = $request->status;
    
    // Define statuses that should reduce stock (consider as "sold")
    $stockReducingStatuses = ['confirmed', 'processing', 'shipped', 'delivered'];
    
    // Define statuses that should restore stock
    $stockRestoringStatuses = ['cancelled'];
    
    try {
        DB::beginTransaction();
        
        // If changing FROM a stock-reducing status TO a non-stock-reducing status
        if (in_array($oldStatus, $stockReducingStatuses) && !in_array($newStatus, $stockReducingStatuses)) {
            // Restore stock (add back to inventory)
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment('total_quantity', $item->quantity);
                }
            }
        }
        
        // If changing FROM a non-stock-reducing status TO a stock-reducing status
        if (!in_array($oldStatus, $stockReducingStatuses) && in_array($newStatus, $stockReducingStatuses)) {
            // Reduce stock (remove from inventory)
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    // Check if enough stock is available
                    if ($item->product->total_quantity < $item->quantity) {
                        throw new \Exception("Insufficient stock for product: {$item->product_name}. Available: {$item->product->total_quantity}, Required: {$item->quantity}");
                    }
                    $item->product->decrement('total_quantity', $item->quantity);
                }
            }
        }
        
        // Special handling for cancelled orders (restore stock regardless of previous status)
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            // Only restore if we haven't already restored above
            if (in_array($oldStatus, $stockReducingStatuses)) {
                // Stock was already restored above, no need to do it again
            } else {
                // This handles cases where order goes from pending directly to cancelled
                // In this case, stock was never reduced, so no need to restore
            }
        }
        
        // Update the order status
        $order->update(['status' => $newStatus]);
        
        DB::commit();
        
        return back()->with('success', 'Order status updated successfully and stock adjusted!');
        
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Failed to update order status: ' . $e->getMessage());
    }
}
    
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // If order is cancelled, restore product quantities
        if ($order->status === 'cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment('total_quantity', $item->quantity);
                }
            }
        }
        
        $order->delete();
        
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}