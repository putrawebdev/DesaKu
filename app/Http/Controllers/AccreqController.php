<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccreqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('status', 'submitted')->get();
        return view('pages.accreq.index', compact('user'));
    }

    /**
     * approve the user
     */
    public function approve(Request $request, string $id)
    {
        $userID = User::findOrFail($id);
        if($userID->status == 'submitted'){
            $userID->status = 'approved';
            $userID->save();
            return redirect()->route('accreq.index')->with('success', 'User approved successfully');
        }
    }
    /**
     * reject the user
     */
    public function reject(Request $request, string $id)
    {
        $userID = User::findOrFail($id);
        if($userID->status == 'submitted'){
            $userID->status = 'rejected';
            $userID->save();
            return redirect()->route('accreq.index')->with('success', 'User rejected successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
