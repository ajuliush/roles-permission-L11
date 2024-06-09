@extends('panel.layouts.app')
@section('content')

<div class="pagetitle">
    <h1>Role</h1>
</div>
@include('message')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Role List</h5>
                        @if(!empty($PermissionAdd))
                        <a href="{{ url('panel/user/add') }}" class="btn btn-primary">Add</a>
                        @endif
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Date</th>
                                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration  }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role->name ?? ''}}</td>
                                <td>{{ $item->created_at }}</td>
                                @if(!empty($PermissionEdit) || !empty($PermissionDelete))
                                <td>
                                    @if(!empty($PermissionEdit))
                                    <a href="{{ url('panel/user/edit',$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                    @if(!empty($PermissionDelete))
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-danger btn-sm delete-user">Delete</a>
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
        document.querySelectorAll('.delete-user').forEach(function(button) {
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
                        form.action = `{{ url('panel/user/delete') }}/${roleId}`;
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
