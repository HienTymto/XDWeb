<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roomallocation;
use Carbon\Carbon;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách phòng và thời gian trống
        $rooms = Roomallocation::where('Date', '>=', Carbon::today())->orderBy('Date')->orderBy('StartTime')->get();
    
        // Lấy danh sách các phòng đã đặt
        $bookedRooms = Roomallocation::where('Date', '>=', Carbon::today())->orderBy('Date')->orderBy('StartTime')->get();
    
        return view('admin.RoomBooking', compact('rooms', 'bookedRooms'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'professor' => 'required',
            'room' => 'required',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        // Kiểm tra xem thời gian đã được đặt hay chưa
        $existingBooking = Roomallocation::where('Date', $request->date)
            ->where('StartTime', $request->time)
            ->where('LabID', $request->room)
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'Phòng đã được đặt trong thời gian này. Vui lòng chọn thời gian khác.');
        }

        // Lưu thông tin đặt phòng
        Roomallocation::create([
            'ProfessorName' => $request->professor,
            'LabID' => $request->room,
            'Date' => $request->date,
            'StartTime' => $request->time,
            'EndTime' => Carbon::parse($request->time)->addHours(2) // Thời gian mặc định là 2 tiếng
        ]);

        return redirect()->back()->with('success', 'Đặt phòng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
