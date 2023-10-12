<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leave;
use App\Http\Controllers\DashboardController;

class DashboardController extends Controller
{
    public function show_dashboard()
    {
        return view('employee.dashboard');
    } 
    public function submitLeaveApplication(Request $request)
    {
    
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required',
            'subject' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required',
        ]);
    
        try {
     
            Leave::create($validatedData);
    
            return back()->with('success', 'Leave application submitted successfully.');
    
        } catch (\Exception $e) {
            
    return back()->with('error', 'Failed to submit leave application. Please try again.');
    
        }
    } 
}

