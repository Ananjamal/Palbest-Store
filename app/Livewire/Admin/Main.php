<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\User; // Make sure to import the User model
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Main extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $weeklySales;
    public $weeklyOrders;
    public $visitors; // Count of users or visitors

    public function mount()
    {
        $this->calculateWeeklyMetrics();
    }

    public function calculateWeeklyMetrics()
    {
        // Get the total number of users (or visitors)
        $this->visitors = User::count(); // Count all users, or use a condition to track active visitors

        // Calculate total sales for the current week
        $this->weeklySales = Order::where('created_at', '>=', Carbon::now()->startOfWeek())
            ->sum('total_amount');

        // Count total orders for the current week
        $this->weeklyOrders = Order::where('created_at', '>=', Carbon::now()->startOfWeek())
            ->count();
    }

    public function render()
    {
        // Return the view with the calculated metrics
        return view('livewire.admin.main', [
            'weeklySales' => $this->weeklySales,
            'weeklyOrders' => $this->weeklyOrders,
            'visitors' => $this->visitors,
        ])->layout('layout.admin.app');
    }
}
    