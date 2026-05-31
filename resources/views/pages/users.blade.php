@extends('layouts.main')

@section('content')
<section class="page-section dashboard-section">
    <div class="container">
        <div class="dashboard-toolbar d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <h2 class="page-title mb-0">User Management</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add User</button>
        </div>

        <div class="page-card mb-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button 
                                    class="btn btn-outline-primary btn-sm edit-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->fullname }}"
                                    data-email="{{ $user->email }}">
                                    Edit
                                </button>
                                <button 
                                    class="btn btn-outline-danger btn-sm delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->fullname }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route('users.add') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route('users.update') }}">
                @csrf
                <input type="hidden" name="user_id" id="editUserId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="fullname" id="editFullName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="editEmail" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="{{ route('users.delete') }}">
                @csrf
                <input type="hidden" name="user_id" id="deleteUserId">
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Script --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    var editModal = document.getElementById('editModal');
    var deleteModal = document.getElementById('deleteModal');

    if(editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            document.getElementById('editUserId').value = button.getAttribute('data-id');
            document.getElementById('editFullName').value = button.getAttribute('data-name');
            document.getElementById('editEmail').value = button.getAttribute('data-email');
        });
    }

    if(deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            document.getElementById('deleteUserId').value = button.getAttribute('data-id');
        });
    }
});
</script>
@endsection