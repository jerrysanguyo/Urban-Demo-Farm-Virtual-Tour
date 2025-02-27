<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function qrScanner()
    {
        return view('qr-scanner');
    }
    
    public function storageLink()
    {
        try {
            Artisan::call('storage:link');
            return redirect()->back()->with('status', 'Storage link created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating storage link: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create storage link. Please check the logs.');
        }
    }
}
