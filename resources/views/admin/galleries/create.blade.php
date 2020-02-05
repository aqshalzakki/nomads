@extends('layouts.admin')

@section('title', 'Add new Travel Package gallery')

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid dynamic-content">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add new Travel Package gallery</h1>
    </div>


    <div class="card-shadow">
        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="travel_package_id">Travel Packages</label>
                    <select class="form-control" name="travel_package_id" id="travel_package_id">
                        <option disabled value="">Choose Travel Package</option>
                        @foreach($travel_packages as $travel_package)
                            <option value="{{ $travel_package->id }}">
                                {{ $travel_package->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input
                        id="image"
                        placeholder="image..."
                        value="{{ old('image') }}"
                        type="file"
                        class="form-control @error('image') is-invalid @enderror"
                        name="image"
                    >

                    @error('image')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    Add New
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
