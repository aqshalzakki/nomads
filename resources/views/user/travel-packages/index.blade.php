@extends('layouts.app')

@section('title', 'Travel Packages')

@section('content')
  <!-- ---------------Hero-Section---------------- -->
    <section id="packagesHero" style="background-image: url({{ url('frontend/images/pic9.jpg')  }});">
     <h1 class="hero-title">Temukan paket travel seperti yang anda inginkan</h1>
     <form class="search-package container" action="{{ route('travel-packages.search') }}">
       <input id="keyword" autocomplete="off" autofocus required type="text" name="keyword" placeholder="Search travel package...">
       <button type="submit">
         <i class="fas fa-fw fa-search"></i>
       </button>
     </form>
     </section>

     <section id="packages">
      <div class="container">

        <div class="categories mb-5">
          @foreach($categories as $category)
            <div data-value="{{ $category->title }}" class="category {{ (request('category') AND $category->isActive()) ? 'active' : '' }}">
              <a class="category-link" href="{{ route('travel-packages.category', $category->title) }}">
                  {{ $category->title }}
              </a>
            </div>
          @endforeach
        </div>

        <div class="filter mb-4">
          <h3 class="category-type">{{ (request('category')->title) ?? 'All' }}</h3>
          <div class="filter-selects">
            <div class="filter-select">
              <select>
                <option selected>Filter</option>
                <option>Filter 1</option>
                <option>Filter 2</option>
                <option>Filter 3</option>
              </select>
              <i class="fas fa-angle-down"></i>
            </div>
            <div class="filter-select">
              <select>
                <option selected>Relevance</option>
                <option>Filter 1</option>
                <option>Filter 2</option>
                <option>Filter 3</option>
              </select>
              <i class="fas fa-angle-down"></i>
            </div>
          </div>
        </div>

        <div class="packages" id="travel-packages">
          <div class="row card-root">
            @foreach ($travelPackages as $travel_package)
              <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                <div class="package-card mb-5">
                  <a href="{{ route('travel-packages.show', $travel_package->slug) }}">
                    @if ($travel_package->hasImage())
                      <div class="travel-img">
                        <img src="{{ $travel_package->firstImageUrl() }}">
                      </div>
                    @endif
                  </a>
                  <div class="body">
                    <a class="package-name" href="{{ route('travel-packages.show', $travel_package->slug) }}">
                      {{ $travel_package->title }}
                    </a>
                    <ul class="options">
                      <li>
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ $travel_package->duration }}</span>
                      </li>
                      <li>
                        <i class="fas fa-fw fa-user"></i>
                        <span>Tour Guide</span>
                      </li>
                      <li>
                        <i class="fas fa-fw fa-user"></i>
                        <span>Include Hotel</span>
                      </li>
                    </ul>
                  </div>
                  <a class="see-detail" href="{{ route('travel-packages.show', $travel_package->slug) }}">See Detail</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </section>
@endsection