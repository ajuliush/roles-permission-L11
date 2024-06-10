@extends('panel.layouts.app')
@section('title', 'Role')
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

                    <form action="{{ url('panel/role/update',$getSingle->id) }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Role Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $getSingle->name }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label style="display: block; margin-bottom: 20px;" for="inputText" class="col-sm-12 col-form-label"><b> Permission</b></label>
                            @foreach($getPermission as $value)
                            <div class="row" style="margin-bottom: 20px;">
                                <div class="col-md-3">
                                    {{ $value['name'] }}
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        @foreach($value['group'] as $group)
                                        @php
                                        $checked = $getRolePermission->contains('permission_id', $group['id']) ? 'checked' : '';
                                        @endphp
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" {{ $checked }} value="{{ $group['id'] }}" name="permission_id[]">
                                                {{ $group['name'] }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
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


@endsection
