@extends('layouts.admin')

@section('title', 'Travel Packages Gallery')

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Travel Packages Gallery</h1>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> 
            Add new Gallery
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
                            <th>Travel</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galleries as $gallery)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $gallery->travel_package->title }}</th>
                                <th>
                                    <img src="{{ imageStoragePath($gallery->image) }}" class="img-thumbnail" style="width: 150px; height: 150px;" />
                                </th>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.gallery.edit', $gallery->id) }}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form class="d-inline" method="post" action="{{ route('admin.gallery.destroy', $gallery->id) }}">
                                        @csrf
                                        @method('delete')

                                        <button onclick="return confirm('Are you sure you want to delete this from the list?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Oops its a 404 :( Travel package gallery not found!</td>
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