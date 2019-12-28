@extends('layouts.admin')

@section('title', 'Transactions')
@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
        {{-- <a href="{{ route('admin.transactions.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> 
            Add new Travel Package
        </a> --}}
    </div>
    
    <div class="row">
        <div class="card-body">
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Travel</th>
                            <th>User</th>
                            <th>Visa</th>
                            <th>Transaction Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr class="text-center">
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->travel_package->title }}</td>
                                <td>{{ $transaction->user->username }}</td>
                                <td>${{ $transaction->additional_visa }}</td>
                                <td>${{ $transaction->total }}</td>
                                <td>{{ $transaction->status->name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.transactions.show', $transaction->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-info" href="{{ route('admin.transactions.edit', $transaction->id) }}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form class="d-inline" method="post" action="{{ route('admin.transactions.destroy', $transaction->id) }}">
                                        @csrf
                                        @method('delete')

                                        <button onclick="return confirm('Are you sure you want to delete {{ $transaction->title }} from the list?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">There is no data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<!-- /.container-fluid -->
@endsection