@extends('layouts.admin')

@section('title', 'Travel Packages')

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Travel Package</h1>
        <a href="{{ route('admin.travel-packages.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> 
            Add new Travel Package
        </a>
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
                            <th>#</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Departure Date</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($travelPackages as $travelPackage)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $travelPackage->title }}</th>
                                <th>{{ $travelPackage->location }}</th>
                                <th>{{ $travelPackage->departure_date }}</th>
                                <th>{{ $travelPackage->type }}</th>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.travel-packages.edit', $travelPackage->id) }}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form class="d-inline" method="post" action="{{ route('admin.travel-packages.destroy', $travelPackage->id) }}">
                                        @csrf
                                        @method('delete')

                                        <button onclick="return confirm('Are you sure you want to delete {{ $travelPackage->title }} from the list?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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