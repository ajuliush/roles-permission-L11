@extends('panel.layouts.app')
@section('title', 'User')
@section('content')

{{-- <div class="pagetitle">
    <h1>Role</h1>
</div> --}}
<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Role</h5>
                    <form action="{{ url('panel/user/store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="">Select Role</option>
                                    @foreach ($getRecord as $item)
                                    <option value="{{ $item->id }}" {{ old('role_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#role_id').select2({
            placeholder: 'Select a role'
            , allowClear: true
        });
    });

</script>
@endsection
