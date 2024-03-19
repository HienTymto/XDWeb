<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Roomallocation;

class BookedRooms extends Component
{
    public $bookedRooms;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->bookedRooms = Roomallocation::all(); // Assign the value to the variable.
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('admin.RoomBooking', compact('bookedRooms'));
    }
}
