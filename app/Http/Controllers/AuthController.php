<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('login');
    }

    public function dashboardMhs()
    {
        $user = Auth::user();
        return view('mhsDashboard', compact('user'));
    }

    // Process login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Check if the login attempt is successful
        if (Auth::attempt($credentials)) {
            // Fetch the user with roles
            $user = User::with('roles')->find(Auth::id());

            // Check if the user has any roles
            if ($user->roles->isEmpty()) {
                return response()->json(['error' => 'User has no roles assigned'], 404);
            }

            // If the user has more than one role, redirect to role selection page
            if ($user->roles->count() > 1) {
                return redirect()->route('selectRole'); // Redirect to role selection page
            }

            // If the user has only one role, directly store it and redirect to dashboard
            $currentRole = $user->roles->first();
            $currentRoleName = trim($currentRole->name);  // Trim here
            Session::put('active_role', $currentRoleName);

            return redirect()->intended($this->getDashboardRoute($currentRoleName));
        }

        return redirect('login')->with('error', 'Invalid email or password');
    }

    // Role selection functionality
    public function selectRolePage()
    {
        $user = User::with('roles')->find(Auth::id());

        // Return a view where user selects their role
        return view('roleSelection', ['roles' => $user->roles]);
    }

    public function selectRole(Request $request)
    {
        $roleId = $request->input('role_id');

        // Fetch the role based on the user's selection
        $user = User::with('roles')->find(Auth::id());
        $selectedRole = $user->roles->where('id', $roleId)->first();

        if ($selectedRole) {
            // Store selected role in session
            $selectedRole = trim($selectedRole->name);  // Trim here
            Session::put('active_role', $selectedRole);

            // Redirect to the selected role's dashboard
            return redirect()->intended($this->getDashboardRoute($selectedRole));
        }

        return redirect()->back()->with('error', 'Role selection failed');
    }

    // Determine the dashboard route based on role
    protected function getDashboardRoute($roleName)
    {
        $user = Auth::user();

        switch ($roleName) {
            case 'Mahasiswa':
                return 'mhs/dashboard';
            case 'Dekan':
                return 'dekan/dashboard';
            case 'Ketua Program Studi':
                return 'kaprodi/dashboard';
            case 'Bagian Akademik':
                return 'staff/dashboard';
            case 'Pembimbing Akademik':
                return 'dosen/dashboard';
            default:
                abort(403, 'Who the fuck are you');
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
