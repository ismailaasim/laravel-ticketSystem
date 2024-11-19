<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShipmentDetail;
use App\Models\ShippmentDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ShipmentNewController extends Controller
{
    public function filterShipments(Request $request)
    {
        $user_id = session('loginId') ?? null;
        if (!$user_id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user_role = $user->role;
        $user_branches = $user->branch; // Comma-separated branches

        $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];
        $selectedBranches = $request->input('branch', []);

        $query = ShipmentDetail::query();

        if (!empty($selectedBranches) && !in_array('all', $selectedBranches)) {
            $query->whereIn('BRANCH', $selectedBranches);
        } elseif (in_array('all', $selectedBranches)) {
            // If 'Select All' is chosen, don't apply any branch filter
        }

        if ($user_role == "Admin") {
            $shipments = $query->get();
          
        } elseif ($user_role == "Manager" || $user_role == "User") {
            $shipments = $branchArray ? $query->whereIn('BRANCH', $branchArray)->get() : collect([]);
        } else {
            $shipments = collect([]);
        }

        // Return the filtered data as JSON
        return response()->json([
            'shipments' => $shipments,
        ]);
    }
}