@extends('dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: { center: 'dayGridMonth,timeGridWeek' },
        initialView: 'dayGridMonth',
        events: [
            @foreach($bookedRooms as $roombooking)
                // Tạo một sự kiện cho mỗi khoảng thời gian trong ngày
                {
                    title: '{{ $roombooking->professor }}',
                    start: '{{ $roombooking->date }}T{{ $roombooking->time }}',
                    end: '{{ $roombooking->date }}T{{ $roombooking->time }}',
                    rendering: 'background', // Hiển thị màu nền cho sự kiện
                    color: '#f0ad4e', // Màu sắc của sự kiện
                    professor: '{{ $roombooking->professor }}',
                    room: '{{ $roombooking->room }}',
                    time: '{{ $roombooking->time }}'
                },
            @endforeach
        ],
        dateClick: function(info) {
            var dateClicked = info.dateStr;
            var events = calendar.getEvents();
            var eventInfo = events.find(event => event.startStr.includes(dateClicked));

            if (eventInfo) {
                alert('Giáo viên: ' + eventInfo.extendedProps.professor + '\nPhòng: ' + eventInfo.extendedProps.room + '\nThời gian: ' + eventInfo.extendedProps.time);
            } else {
                alert('Không có sự kiện nào vào ngày ' + dateClicked);
            }
        }
    });
    calendar.render();
});

    </script>
    
    <div class="card">

        <div class="card-header">
            <h4>Quản lý đặt phòng máy</h4>
        </div>
        <div class="card-body">
            <div class="room-booking">
                <form method="POST" action="{{ route('roombooking.store') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Giáo viên</span>
                        </div>
                        <input type="text" class="form-control" id="professor" name="professor" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Phòng máy</span>
                        </div>
                        <input type="text" class="form-control" id="room" name="room" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Ngày</span>
                        </div>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Thời gian</span>
                        </div>
                        <select class="form-control" id="time" name="time" required>
                            <option value="7:00">7:00 - 9:30</option>
                            <option value="9:35">9:35 - 12:05</option>
                            <option value="12:35">12:35 - 15:05</option>
                            <option value="15:10">15:10 - 17:40</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Đặt phòng</button>
                </form>
            </div>
        </div>


    </div>

    <div class="card">
        <div class="card-header">
            <h4>Danh sách phòng đã đặt</h4>
        </div>
        <div class="card-body">
            <div class="room-booked">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection
