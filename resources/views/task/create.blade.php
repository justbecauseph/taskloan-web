@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Create Task
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <form action="{{ route('task.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="titleInput">Title</label>
                                        <input type="text" id="titleInput" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptionInput">Description</label>
                                        <textarea name="description" id="descriptionInput" cols="30" rows="10"
                                                  class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="amountInput">Amount (&#x20b1;)</label>
                                        <input type="number" id="amountInput" class="form-control" name="amount" min="10" value="10">
                                    </div>

                                    <button class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
