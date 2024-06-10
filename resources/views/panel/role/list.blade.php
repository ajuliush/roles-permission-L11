@extends('panel.layouts.app')
@section('title', 'Role')
@section('content')

{{-- <div class="pagetitle">
    <h1>Role</h1>
</div> --}}
@include('message')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Role List</h5>
                        @if(!empty($PermissionAdd))
                        <a href="{{ url('panel/role/add') }}" class="btn btn-primary btn-sm">Add</a>
                        @endif
                    </div>
                    <!-- Search Form -->
                    <form method="GET" action="{{ url('panel/role') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            @if(request('search'))
                            <a href="{{ url('panel/role') }}" class="btn btn-secondary btn-sm">Reset</a>
                            @endif
                        </div>
                    </form>
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                                <td>
                                    @if(!empty($PermissionEdit))
                                    <a href="{{ url('panel/role/edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                    @if(!empty($PermissionDelete))
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-danger btn-sm delete-role">Delete</a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $getRecord->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-role').forEach(function(button) {
            button.addEventListener('click', function() {
                const roleId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?'
                    , text: "You won't be able to revert this!"
                    , icon: 'warning'
                    , showCancelButton: true
                    , confirmButtonColor: '#3085d6'
                    , cancelButtonColor: '#d33'
                    , confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, create a form and submit it
                        const form = document.createElement('form');
                        form.action = `{{ url('panel/role/delete') }}/${roleId}`;
                        form.method = 'POST';

                        // Add CSRF token input
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';
                        form.appendChild(csrfInput);

                        // Add method spoofing input for DELETE method
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        form.appendChild(methodInput);

                        // Append the form to the body and submit it
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });

</script>
@endsection
