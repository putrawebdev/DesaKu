<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userList = User::where('role_id', 2)->where('status', '!=', 'submitted')->get();
        return view('pages.useracc.index', compact('userList'));
    }

    /**
     * approve the user
     */
    public function approve(Request $request, string $id)
    {
        $userID = User::findOrFail($id);
        $userID->status = 'approved';
        $userID->save();
        return redirect()->route('userManage.index')->with('success', 'User approved successfully');
        
    }
    /**
     * reject the user
     */
    public function reject(Request $request, string $id)
    {
        $userID = User::findOrFail($id);
        $userID->status = 'rejected';
        $userID->save();
        return redirect()->route('userManage.index')->with('success', 'User rejected successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userID = User::findOrFail($id);
        $userID->delete();
        return redirect()->route('userManage.index')->with('success', 'User deleted successfully');
    }
}
