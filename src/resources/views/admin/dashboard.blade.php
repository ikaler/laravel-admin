@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Dashboard</h1>

            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}</li>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection