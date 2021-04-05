@extends('layouts.admin')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard') }}</li>
  </ol>
</nav>

<div class="row">
    <div class="col">
        {{ __('Welcome to dashboard!') }}
    </div>            
</div>

@endsection