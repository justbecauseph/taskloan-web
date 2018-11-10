@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="d-inline-block align-middle">Wallet</span>
                        <a href="#" class="btn btn-primary btn-sm">Top-up</a>
                    </div>
                    <div class="card-body">
                        <span class="font-weight-bold">
                            &#x20b1; {{ number_format($auth_user->wallet_amount, 2) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="d-inline-block align-middle">Tasks</span>
                        <a href="{{ route('task.create') }}" class="btn btn-primary btn-sm">Create Task</a>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
