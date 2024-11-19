<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserListController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user_id = session('loginId') ?? null;
    //     if ($user_id) {
    //         $user = User::find($user_id);
    //         if ($user) {
    //             $user_role = $user->role;
    //             $user_branches = $user->branch; // Comma-separated branches
    //             $loggedInUserName = $user->name;
    //             $loggedInUserDesignation = $user->role;
    //         } else {
    //             $user_role = null;
    //             $user_branches = null;
    //             $loggedInUserName = '';
    //             $loggedInUserDesignation = '';
    //         }
    //     }
    //     //-------------------------- Old User Query Start 
    //     // $query = User::query();

    //     // if ($request->has('branch') && !empty($request->branch)) {
    //     //     if (in_array('all', $request->branch)) {
    //     //         // No filter applied, show all branches
    //     //     } else {
    //     //         $query->where(function ($q) use ($request) {
    //     //             foreach ($request->branch as $branch) {
    //     //                 $q->orWhere('branch', 'LIKE', '%' . $branch . '%');
    //     //             }
    //     //         });
    //     //     }
    //     // }
    //     // if ($request->has('role') && !empty($request->role)) {
    //     //     $query->where('role', $request->role);
    //     // }
    //     // $users = $query->get();
    //     //-------------------------- Old User Query Start - End
    //     // Split branches into an array
    //     $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];

    //     if (!empty($user_role) && $user_role == "Admin") {
    //         // Fetch shipments that match the user's branches
    //         $shipments_count =  DB::table('shipment_details')->count();
    //         $UsersCount = User::count();
    //         $users = User::get();
    //     } else if (!empty($user_role) && ($user_role == "Manager" || $user_role == "User")) {
    //         // Fetch shipments that match the user's branches
    //         $shipments_count = !empty($branchArray)
    //             ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->count()
    //             : 0; // Empty collection if no branches

    //         $shipmentsDetails = !empty($branchArray)
    //             ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->get()
    //             : 0; // Empty collection if no branches
    //         $usersQuery = User::where(function ($q) use ($branchArray) {
    //             foreach ($branchArray as $branch) {
    //                 // Add multiple LIKE conditions
    //                 $q->orWhere('branch', 'LIKE', "%$branch%");
    //             }
    //         });
    //         $users = $usersQuery->get();
    //         $UsersCount = $usersQuery->count();
    //         if ($user_role != "User") {
    //             // $UsersList = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->get();
    //             //   $UsersCount = $usersQuery->where('id', '!=', $user_id)->where('role', '!=', 'Admin')->count();
    //             $UsersCount = $usersQuery->where('role', '!=', 'Admin')->count();
    //         } else {
    //             $UsersCount = 0;
    //         }
    //     }

    //     // $users = User::all();
    //     $pageName = 'Users'; // Example dynamic data
    //     $branches = Branch::where('branch_status', 'active')->get();
    //     return view('Backend.userListPage', compact('pageName', 'users', 'branches', 'loggedInUserName', 'loggedInUserDesignation', 'UsersCount', 'shipments_count'));
    // }
    public function index(Request $request)
    {
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
        }

        // Split branches into an array
        $branchArray = !empty($user_branches) ? explode(',', $user_branches) : [];

        // Initialize the query for filtering
        $query = User::query();

        // Admin role can see all users
        if (!empty($user_role) && $user_role == "Admin") {
            $shipments_count = DB::table('shipment_details')->count();
            $UsersCount = User::count();
            // Apply filters for admin
            if ($request->has('branch') && !empty($request->branch)) {
                if (!in_array('all', $request->branch)) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->branch as $branch) {
                            $q->orWhere('branch', 'LIKE', '%' . $branch . '%');
                        }
                    });
                }
            }
            if ($request->has('role') && !empty($request->role)) {
                $query->where('role', $request->role);
            }
            $users = $query->get();
        }
        // Manager or User role only sees users in their branches
        else if (!empty($user_role) && ($user_role == "Manager" || $user_role == "User")) {
            // Fetch shipments that match the user's branches
            $shipments_count = !empty($branchArray)
                ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->count()
                : 0;

            $shipmentsDetails = !empty($branchArray)
                ? DB::table('shipment_details')->whereIn('BRANCH', $branchArray)->get()
                : 0;

            $query->where(function ($q) use ($branchArray) {
                foreach ($branchArray as $branch) {
                    $q->orWhere('branch', 'LIKE', "%$branch%");
                }
            });

            // Apply additional filters for Manager/User
            if ($request->has('branch') && !empty($request->branch)) {
                if (!in_array('all', $request->branch)) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->branch as $branch) {
                            $q->orWhere('branch', 'LIKE', '%' . $branch . '%');
                        }
                    });
                }
            }

            if ($request->has('role') && !empty($request->role)) {
                $query->where('role', $request->role);
            }

            $users = $query->get();
            $UsersCount = $query->count();

            if ($user_role == "Manager") {
                $UsersCount = $query->where('role', '!=', 'Admin')->count();
            } else {
                $UsersCount = 0;
            }
        }

        $pageName = 'Users';
        $branches = Branch::where('branch_status', 'active')->get();

        return view('Backend.userListPage', compact('pageName', 'users', 'branches', 'loggedInUserName', 'loggedInUserDesignation', 'UsersCount', 'shipments_count'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'branch' => 'required|array',
            'role' => 'required|in:Admin,Manager,User',
            'address' => 'required|string',
            'gender' => 'required|in:male,female,others',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
            $imageBase64 = base64_encode($imageData);
            $imagePath = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . $imageBase64;
            // dd($image);
        } else {
            $imagePath = null;
        }
        $branches = $request->input('branch');
        $branches = array_filter($branches, function ($value) {
            return $value !== 'all';
        });

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            //    'branch' => json_encode($request->input('branch')),
            // 'branch' => implode(',', $request->input('branch')),
            'branch' => implode(',', $branches),
            'role' => $request->input('role'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
            'image' => $imagePath
        ]);
        return response()->json(['message' => 'User created successfully', 'user' => route('user-List')], 200);
    }
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        return response()->json([
            'name' => $user->name,
            'gender' => $user->gender,
            'email' => $user->email,
            'branch' => $user->branch,
            'role' => $user->role,
            'address' => $user->address,
            'image' => $user->image
        ]);
    }
    public function update(Request $request, $id)
    {
        // return response()->json(['data' => $request->all()]);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'branch' => 'required|array',
            'role' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $branches = $request->input('branch');

        // Remove "all" from the branch array if it exists
        $branches = array_filter($branches, function ($value) {
            return $value !== 'all';
        });

        // Convert the filtered array to a comma-separated string
        $branchString = implode(',', $branches);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = file_get_contents($image->getRealPath());
            $imageBase64 = base64_encode($imageData);
            $imagePath = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . $imageBase64;
        } else {
            $imagePath = $user->image; // Use existing image if no new image is uploaded
        }
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->branch = $branchString;
        $user->role = $request->role;
        $user->address = $request->address;
        $user->image = $imagePath;
        $user->save();
        return response()->json(['success' => 'User updated successfully', 'redirect' => route('user-List')]);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => 'User deleted successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    // public function shipmentDetails()
    // {

    //     $pageName = 'Shipment'; // Example dynamic data
    //     return view('Backend.ship-detail', compact('pageName'));
    // }

    // new code start
    public function generatePassword(Request $request, $id)
    {
        // Validate the request (ensure the password is provided)
        $request->validate([
            'password' => 'required|string|min:8|max:15'
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Hash the generated password
        $hashedPassword = Hash::make($request->password);

        // Update the user's password in the database
        $user->password = $hashedPassword;
        $user->save();

        // Prepare the data for the email template
        $data = [
            'user' => $user,
            'password' => $request->password,
        ];

        // Send the generated password to the user's email using the HTML template
        Mail::html($this->getPasswordEmailTemplate($data), function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your New Password');
        });

        // Return a JSON response
        return response()->json(['success' => 'Password generated and sent to the user\'s email.']);
    }

    private function getPasswordEmailTemplate($data)
    {
        return '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your New Password</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                padding: 20px;
                background-color: #ffffff;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                margin: 20px auto;
                max-width: 600px;
                border-radius: 8px;
            }
            .header {
                background-color: #007bff;
                padding: 20px;
                border-radius: 8px 8px 0 0;
                color: #ffffff;
                text-align: center;
            }
            .header h1 {
                margin: 0;
                font-size: 24px;
            }
            .content {
                padding: 20px;
                color: #333333;
            }
            .content p {
                font-size: 16px;
                line-height: 1.5;
                margin: 10px 0;
            }
            .content .password {
                font-size: 18px;
                font-weight: bold;
                color: #007bff;
                margin: 20px 0;
                text-align: center;
            }
            .footer {
                padding: 20px;
                text-align: center;
                font-size: 14px;
                color: #777777;
            }
            .footer a {
                color: #007bff;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Welcome to [Your Company Name]</h1>
            </div>
            <div class="content">
                <p>Dear ' . $data['user']->name . ',</p>
                <p>We have generated a new password for your account at [Your Company Name]. Please use the following password to log in:</p>
                <div class="password">' . $data['password'] . '</div>
                <p>For security reasons, we recommend changing your password after logging in.</p>
                <p>If you did not request this change or if you have any questions, please contact our support team immediately.</p>
                <p>You can log in by clicking the link below:</p>
                <p><a href="' . route('login') . '">Click here to log in</a></p>
            </div>
            <div class="footer">
                <p>Thank you for being part of [Your Company Name]!</p>
                <p>Best Regards,<br>[Your Company Name] Team</p>
                <p><a href="https://www.yourcompany.com">https://www.yourcompany.com</a></p>
            </div>
        </div>
    </body>
    </html>';
    }
    // new code end
}
