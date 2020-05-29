@foreach ($travelPackages as $travel_package)
  <div class="col-lg-4 col-md-4 col-sm-6 col-6">
    <div class="package-card mb-5">
      <a href="{{ route('travel-packages.show', $travel_package->slug) }}">
        @if($travel_package->hasImage())
          <div class="travel-img">
            <img src="{{ $travel_package->hasImage() }}">
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