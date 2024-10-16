<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\RequestItem;
use App\Models\SubmissionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Dashboard Info
 * 
 * API endpoints for admin dashboard
 */
class DashboardController extends Controller
{
    /**
     * Get counts of items, users and requests + submssions
     */
    public function getCounts()
    {
        return response()->json([
            'items' => Item::count(),
            'users' => User::count(),
            'requests' => RequestItem::count(),
            'submissions' => SubmissionItem::count(),
        ]);
    }

    /**
     * Get stats of requests item, group by month
     */
    public function getStatsRequest()
    {
        $data = DB::table('request_items')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), 'asc')
            ->get();

        $labels = $data->pluck('month')->toArray();
        $values = $data->pluck('total')->toArray();
        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    /**
     * Get stats of items
     */
    public function getStatsItem()
    {
        // get all categories and count their items
        $data = Category::withCount('items')->get();

        $labels = $data->pluck('name')->toArray();
        $values = $data->pluck('items_count')->toArray();
        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
