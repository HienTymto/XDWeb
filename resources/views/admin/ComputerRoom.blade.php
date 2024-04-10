@extends('dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

<div class="card">
    <div class="card-header">
        <div class="float-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLabModal">Thêm phòng</button>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($labs as $lab)
                <tr>
                    <td>{{ $lab->Name }}</td>
                    <td>{{ $lab->Location }}</td>
                    <td>
                        <a href="{{ route('updateLab', ['id' => $lab->LabID]) }}" class="btn btn-primary">Sửa</a>
                        <a href="{{ route('deleteLab', ['id' => $lab->LabID]) }}" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addLabModal" tabindex="-1" aria-labelledby="addLabModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabModalLabel">Thêm phòng máy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addLabForm" method="POST" action="{{ route('addLab') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="labName" class="form-label">Tên phòng</label>
                        <input type="text" class="form-control" id="labName" name="labName">
                    </div>
                    <div class="mb-3">
                        <label for="labLocation" class="form-label">Địa điểm</label>
                        <input type="text" class="form-control" id="labLocation" name="labLocation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    new DataTable('#example');
</script>

@endsection
