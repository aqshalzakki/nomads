@extends('layouts.admin')

@section('title', "Edit Gallery")

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Gallery Travel</h1>
    </div>


    <div class="card-shadow">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{ route('admin.gallery.update', $gallery->id) }}" method="post">
                @csrf
                @method('patch')
                
                <div class="form-group">
                    <label for="travel_package_id">Travel Packages of</label>
                    <select class="form-control" name="travel_package_id" id="travel_package_id">
                        @foreach($travel_packages as $travel_package)
                            @if($travel_package->id == $gallery->travel_package_id)
                            
                                <option selected value="{{ $travel_package->id }}"> {{ $travel_package->title }} </option>

                            @else
                                
                                <option value="{{ $travel_package->id }}"> {{ $travel_package->title }} </option>

                            @endif
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
                    @else
                        <small class="ml-2">Choose a new image to be updated</small>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection