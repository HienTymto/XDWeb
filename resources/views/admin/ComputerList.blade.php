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
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addComputerModal">Thêm máy tính</button>
        </div>
    </div>
    <div class="card-body">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Tình trạng</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($computers as $computer)
                <tr>
                    <td>{{ $computer->Name }}</td>
                    <td>{{ $computer->Status }}</td>
                    <td>
                        <a href="{{ route('deleteComputer', ['id' => $computer->ComputerID]) }}" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addComputerModal" tabindex="-1" aria-labelledby="addComputerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addComputerModalLabel">Thêm máy tính</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addComputerForm" action="{{ route('addComputer') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="computerName" class="form-label">Tên máy tính</label>
                        <input type="text" class="form-control" id="computerName" name="computerName">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Đang hoạt động">Đang hoạt động</option>
                            <option value="Bảo trì">Bảo trì</option>
                            <option value="Hư hỏng">Hư hỏng</option>
                        </select>
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
