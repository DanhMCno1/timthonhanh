<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Auth;

class StaffsSearchingController extends Controller
{
    public function staffsSearching(Request $request) {
        $categories = Category::pluck('name', 'id')->all();
        $staffs = Staff::select(['id', 'name', 'description']);

        if ($request->has('category_id')) {
            $staffs->whereHas('categories', function($staffs) use ($request) {
                $staffs->where('categories.id', $request->input('category_id'));
            });
        }
        if ($request->has('province_id')) {
            $staffs->whereHas('workAreas', function($staffs) use ($request) {
                $staffs->where('province_id', $request->get('province_id'));
            });
        }

        if ($request->has('district_id')) {
            $staffs->whereHas('workAreas', function($staffs) use ($request) {
                $staffs->where('district_id', $request->get('district_id'));
            });
        }
        $staffs->with(['workAreas']);
        $staffCount = $staffs->count();
        $staffs = $staffs->paginate(10);
        return view('users.staffs-searching', compact('staffs','categories','staffCount'));
    }
    public function sendRequest(Request $request) {
        $categoryId = $request->input('category_id');
        $staffId = $request->input('staff_id');

        $req = new RequestModel();
        $req->category_id = $categoryId;
        $req->staff_id = $staffId;
        $req->user_id = Auth::user()->id;
        $req->save();
        return response()->json([
            'message' => 'Request received successfully',
        ]);
    }

}
