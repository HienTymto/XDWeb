<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComputerList extends Controller
{
    public function index()
    {
        $computers = Computer::all();
        return view('admin.ComputerList', compact('computers'));
    }

    // Add Computer function
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'computerName' => 'required|string|max:255',
            'status' => 'required|string|max:255' // Thêm rule cho trường status
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $computer = new Computer();
        $computer->Name = $request->computerName;
        $computer->Status = $request->status; // Lưu trạng thái từ request
        $computer->save();

        return redirect()->back()->with('success', 'Computer added successfully');
    }


    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy($id)
    {
        $computer = Computer::findOrFail($id);
        $computer->delete();

        return redirect()->back()->with('success', 'Computer deleted successfully');
    }
}
