<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;

class ComputerRoom extends Controller
{
    public function index()
    {
        $labs = Lab::all();
        return view('admin.ComputerRoom', compact('labs'));
    }

    // Add Lab function
    public function addLab(Request $request)
{
    $request->validate([
        'labName' => 'required|string|max:255',
        'labLocation' => 'required|string|max:255',
    ]);

    $lab = new Lab();
    $lab->Name = $request->labName;
    $lab->Location = $request->labLocation;
    $lab->save();

    return redirect()->route('computer-room')->with('success', 'Lab added successfully');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lab = Lab::findOrFail($id);
        return view('admin.ComputerRoom', compact('lab'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        return view('admin.ComputerRoom', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'labName' => 'required|string|max:255',
            'labLocation' => 'required|string|max:255',
        ]);

        $lab = Lab::findOrFail($id);
        $lab->Name = $request->labName;
        $lab->Location = $request->labLocation;
        $lab->save();

        return redirect()->route('computer-room')->with('success', 'Lab updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $lab = Lab::findOrFail($id);
    $lab->delete();

    return redirect()->route('computer-room')->with('success', 'Lab deleted successfully');
}
}
