<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\GroceryItem;
use App\Models\User;

class AuthController extends Controller
{
    /* Show Login Page */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /* Show Register Page */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    /* Handle Login */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ])->withInput($request->only('email'));
    }

    /* Handle Register */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created! Please sign in.');
    }

    /* Handle Logout */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function index()
    {
        /* ==================== STAT COUNTS ==================== */
        $totalUsers     = User::count();
        $totalItems     = GroceryItem::count();
        $completedItems = GroceryItem::where('status', 'completed')->count();
        $pendingItems   = GroceryItem::where('status', 'pending')->count();
 
        /* ==================== RECENT DATA ==================== */
        $recentItems = GroceryItem::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
 
        /* ==================== BAR CHART – Items Per Month ==================== */
        $monthly = GroceryItem::select(
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month', DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
 
        $barLabels = $monthly->pluck('month');
        $barData   = $monthly->pluck('total');
 
        /* ==================== DONUT CHART – Items by Category ==================== */
        $categories = GroceryItem::select(
                'category',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('category')
            ->get();
 
        $donutLabels = $categories->pluck('category');
        $donutData   = $categories->pluck('total');
 
        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'totalItems' => $totalItems,
            'completedItems' => $completedItems,
            'pendingItems' => $pendingItems,

            'recentItems' => $recentItems,
            'recentUsers' => $recentUsers,

            'barLabels' => $barLabels,
            'barData' => $barData,

            'donutLabels' => $donutLabels,
            'donutData' => $donutData,
        ]);
    }
}