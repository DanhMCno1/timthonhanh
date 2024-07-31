<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Repositories\Request\RequestRepositoryInterface;
use App\Repositories\Staff\StaffRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected StaffRepositoryInterface $staffRepo;
    protected RequestRepositoryInterface $requestRepo;
    protected $staff;

    public function __construct(StaffRepositoryInterface $staffRepo, RequestRepositoryInterface $requestRepo)
    {
        $this->staffRepo = $staffRepo;
        $this->requestRepo = $requestRepo;
        $this->staff = Auth::guard('staff')->user();
    }

    public function index(Request $request)
    {
        if ($request->has('category_id')) {
            $categoryId = $request->get('category_id');

            $requests = $this->staff->requests()
                ->with('category', 'user')
                ->when($categoryId != 0, function ($query, $categoryId) {
                    return $query->where('category_id', $categoryId);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->withQueryString();

            return response()->json([
                'view' => view('staffs.requests', compact('requests'))->render(),
            ]);
        }

        $categories = $this->staff->requests()
            ->select('category_id as id', 'categories.name as name', DB::raw('count(requests.id) as total'))
            ->join('categories', 'requests.category_id', '=', 'categories.id')
            ->groupBy('category_id', 'categories.name')
            ->orderBy('category_id', 'asc')
            ->get();

        $waitingOrderCount = $this->staff->orders->where('status', 'waiting')->count();

        return view('staffs.home', [
            'staff' => $this->staff,
            'categories' => $categories,
            'waitingOrderCount' => $waitingOrderCount,
        ]);
    }
}
