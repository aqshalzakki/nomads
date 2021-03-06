@extends('layouts.admin')

@section('title', 'Add new Travel Package')

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid dynamic-content">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add new Travel Package</h1>
    </div>


    <div class="card-shadow">
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ route('admin.travel-packages.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="title">Title :</label>
                    <input
                        id="title"
                        placeholder="Title..."
                        value="{{ old('title') }}"
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        name="title"
                    >

                    @error('title')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location :</label>
                    <input
                        id="location"
                        placeholder="Location..."
                        value="{{ old('location') }}"
                        type="text"
                        class="form-control @error('location') is-invalid @enderror"
                        name="location"
                    >

                    @error('location')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="about">About :</label>
                    <textarea
                        name="about"
                        id="about"
                        rows="10"
                        class="d-block w-100 form-control @error('about') is-invalid @enderror"
                    >{{ old('about') }}</textarea>

                    @error('about')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="featured_event">Featured event :</label>
                    <input
                        id="featured_event"
                        placeholder="Featured event..."
                        value="{{ old('featured_event') }}"
                        type="text"
                        class="form-control @error('featured_event') is-invalid @enderror"
                        name="featured_event"
                    >

                    @error('featured_event')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="language">Language :</label>
                    <input
                        id="language"
                        placeholder="Language..."
                        value="{{ old('language') }}"
                        type="text"
                        class="form-control @error('language') is-invalid @enderror"
                        name="language"
                    >

                    @error('language')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foods">Foods :</label>
                    <input
                        id="foods"
                        placeholder="Foods..."
                        value="{{ old('foods') }}"
                        type="text"
                        class="form-control @error('foods') is-invalid @enderror"
                        name="foods"
                    >

                    @error('foods')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="departure_date">Departure Date :</label>
                    <input
                        id="departure_date"
                        placeholder="Departure Date..."
                        value="{{ old('departure_date') }}"
                        type="date"
                        class="form-control @error('departure_date') is-invalid @enderror"
                        name="departure_date"
                    >

                    @error('departure_date')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Duration :</label>
                    <input
                        id="duration"
                        placeholder="Duration..."
                        value="{{ old('duration') }}"
                        type="text"
                        class="form-control @error('duration') is-invalid @enderror"
                        name="duration"
                    >

                    @error('duration')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">Type :</label>
                    <input
                        id="type"
                        placeholder="Type..."
                        value="{{ old('type') }}"
                        type="text"
                        class="form-control @error('type') is-invalid @enderror"
                        name="type"
                    >

                    @error('type')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Category :</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            @if($category->title != 'All')
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endif
                        @endforeach
                    </select>

                    @error('category_id')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price :</label>
                    <input
                        id="price"
                        placeholder="Price..."
                        value="{{ old('price') }}"
                        type="number"
                        class="form-control @error('price') is-invalid @enderror"
                        name="price"
                    >

                    @error('type')
                        <div class="ml-2 invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group ml-2">
                    <input id="add_more" type="checkbox" name="add_more">
                    <label style="user-select: none;" for="add_more">Create more travel package after this</label>
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
