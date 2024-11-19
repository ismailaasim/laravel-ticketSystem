<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
  public function dashboard()
  {
    if (Session::has('loginId')) {
      return view('Backend.dashboard');
    }
    return redirect('/')->with('fail', 'You have to Login first');
  }

  public function showDashboard()
  {
    // if(session()->has('loginId')){
    //   $user_id = session('loginId') ?? null;
    //   $loginURole = session('loginURole') ?? null;
    //   $loginUbranch = session('loginUbranch') ?? null;
    // }
    // Retrieve session data
    $user_id = session('loginId') ?? null;
    if ($user_id) {
      $user = User::find($user_id);
      if ($user) {
        $user_role = $user->role;
        $user_branches = $user->branch; // Comma-separated branches
        $loggedInUserName = $user->name;
        $loggedInUserDesignation = $user->role;
      } else {
        $user_role = null;
        $user_branches = null;
        $loggedInUserName = '';
        $loggedInUserDesignation = '';
      }

  
      // Split branches into an array
      $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];

      if (!empty($user_role) && $user_role == "Admin") {
        // Fetch shipments that match the user's branches
        $shipments_count =  DB::table('shipment_details')->count();
        $UsersCount = User::count();
      } else if (!empty($user_role) && ($user_role == "Manager" || $user_role == "User")) {
        // Fetch shipments that match the user's branches
        $shipments_count = !empty($branchArray)
          ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->count()
          : 0; // Empty collection if no branches

        $shipmentsDetails = !empty($branchArray)
          ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->get()
          : 0; // Empty collection if no branches
        $usersQuery = User::where(function ($q) use ($branchArray) {
          foreach ($branchArray as $branch) {
            // Add multiple LIKE conditions
            $q->orWhere('branch', 'LIKE', "%$branch%");
          }
        });
        if ($user_role != "User") {
          // $UsersCount = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->count();
          $UsersCount = $usersQuery->where('role', '!=', 'Admin')->count();
        } else {
          $UsersCount = 0;
        }
      }
      // Pass the shipments to a view or further process them
      // return view('dashboard', compact('shipments'));
      $pageName = 'Users'; // Example dynamic data
      return view('Backend.dashboard', compact('pageName', 'UsersCount', 'shipments_count','loggedInUserName','loggedInUserDesignation'));
    }


    // $pageName = 'User Count'; // Example dynamic data
    // return view('Backend.dashboard', compact('pageName'));
  }
  public function shipmentDetails()
  {
    $pageName = 'Shipment'; // Example dynamic data
    return view('Backend.ship-detail', compact('pageName'));
  }
  public function logout(Request $request)
  {

    // if (Session::has('loginId')) {
    //   Session::pull('loginId');
    //   return redirect('/'); }
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect('/');
  }
}
