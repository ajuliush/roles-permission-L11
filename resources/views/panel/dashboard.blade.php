@extends('panel.layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="pagetitle">
    <h1>Dashboard</h1>
</div>
@include('message')

{{ Auth::user()->role->name }}

@endsection
