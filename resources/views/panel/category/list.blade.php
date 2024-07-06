@extends('panel.layouts.app')
@section('title', 'Category')
@section('content')

{{-- <div class="pagetitle">
    <h1>Role</h1>
</div> --}}
<div id="session-message" class="alert alert-success" style="display: none;"></div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Category List</h5>
                        @if(!empty($PermissionAdd))
                        {{-- <a href="{{ url('panel/category/add') }}" class="btn btn-primary btn-sm">Add</a> --}}
                        <!-- Vertically centered Modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                            Add Category
                        </button>
                        <div class="modal fade" id="verticalycentered" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="categoryForm" action="{{ url('panel/category/store') }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                            <span id="name-error" class="text-danger" style="display: none;"></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <style>
                            .is-invalid {
                                border-color: #dc3545;
                            }

                        </style>

                        <!-- End Vertically centered Modal-->
                        @endif
                    </div>
                    <!-- Search Form -->
                    <form method="GET" action="{{ url('panel/category') }}" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            @if(request('search'))
                            <a href="{{ url('panel/category') }}" class="btn btn-secondary btn-sm">Reset</a>
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
<script>
    $(document).ready(function() {
        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action')
                , method: 'POST'
                , data: new FormData(this)
                , processData: false
                , contentType: false
                , success: function(response) {
                    // Show success message
                    $('#session-message').text('Category created successfully.').show();

                    // Clear the form and remove error states
                    $('#categoryForm')[0].reset();
                    $('#name').removeClass('is-invalid');
                    $('#name-error').text('').hide();

                    // Optionally close the modal
                    $('#verticalycentered').modal('hide');

                    // Optionally redirect after a delay
                    setTimeout(function() {
                        window.location.href = "{{ route('category.index') }}";
                    }, 2000); // Adjust the delay as needed
                }
                , error: function(response) {
                    if (response.status === 422) {
                        // Display validation errors
                        let errors = response.responseJSON.errors;
                        if (errors.name) {
                            $('#name').addClass('is-invalid');
                            $('#name-error').text(errors.name[0]).show();
                        }
                    }
                }
            });
        });
    });

</script>

@endsection
