@extends('layouts.admin')

@section('title', "Change Transaction status")

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid dynamic-content">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Change Transaction status from <b>{{ $transaction->user->username }}</b></h1>
    </div>


    <div class="card-shadow">
        <div class="card-body">
            <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="status">From :</label>
                            <input class="form-control" type="text" disabled value="{{ $transaction->status->name }}">
                        </div>
                        <div class="col-6">
                            <label for="status">To :</label>
                            <select
                                class="form-control @error('transaction_status_id') is-invalid @enderror" name="transaction_status_id"
                                id="status">
                                @foreach($statuses as $status)
                                    @if($transaction->status->id == $status->id)

                                        <option selected disabled value="">{{ $status->name }}</option>

                                    @else

                                        <option value="{{ $status->id }}">{{ $status->name }}</option>

                                    @endif
                                @endforeach
                            </select>
                            @error('transaction_status_id')
                                <div class="invalid-feedback ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button onclick="return confirm('Confirm Status changes?')" type="submit" class="btn btn-primary btn-block">
                    Confirm Status
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
