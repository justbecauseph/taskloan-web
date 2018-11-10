@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        Welcome back, {{ $auth_user->name }}!
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Wallet</div>
                    <div class="card-body">
                        <span class="font-weight-bold">
                            &#x20b1; {{ number_format($auth_user->wallet_amount, 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
