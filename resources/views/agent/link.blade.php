@extends('layouts.app')

@section('title', 'Agent Payment Link')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>{{ $agentLink->name }}</h4>
            </div>
            <div class="card-body">
                @if($agentLink->description)
                <p>{{ $agentLink->description }}</p>
                @endif

                @auth
                <div class="alert alert-info">
                    <p>You are logged in. You can proceed to make a payment.</p>
                    <a href="{{ route('user.payments.create') }}" class="btn btn-primary">Make Payment</a>
                </div>
                @else
                <div class="alert alert-warning">
                    <p>Please login to make a payment using this agent link.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

