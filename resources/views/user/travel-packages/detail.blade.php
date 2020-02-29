@extends('layouts.app')

@section('title', 'Detail Travel')

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
      <div class="container">
        <div class="row">
          <div class="col p-0 pl-3 pl-lg-0">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">
                  <a style="color: #071C4D;" aria-current="page" href="{{ route('travel-packages.category', 'All') }}">
                    Travel Package
                  </a>
                </li>
                
                <li class="breadcrumb-item active" aria-current="page">
                   {{ $travelPackage->title }}
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-8 pl-lg-0">
              <div class="card card-details">
                <h1>{{ $travelPackage->title }}</h1>
                <p>
                  {{ $travelPackage->location }}
                </p>
                  <div class="gallery">
                    @if($travelPackage->galleries->count())
                      <div class="xzoom-container">
                        <img
                          class="xzoom"
                          id="xzoom-default"
                          src="{{ Storage::url($travelPackage->galleries->first()->image) }}"
                          xoriginal="{{ Storage::url($travelPackage->galleries->first()->image) }}"
                        />
                        <div class="xzoom-thumbs">
                          @foreach($travelPackage->galleries as $gallery)  
                            <a href="{{ Storage::url($gallery->image) }}">
                              <img
                                class="xzoom-gallery"
                                width="128"
                                src="{{ Storage::url($gallery->image) }}"
                                xpreview="{{ Storage::url($gallery->image) }}"
                              />
                            </a>
                          @endforeach
                        </div>
                      </div>
                    @endif
                    <h2>About Destination</h2>
                    <p>
                      {!! nl2br($travelPackage->about) !!}
                    </p>
                    <div class="features row pt-3">
                      <div class="col-md-4">
                        <img
                          src="{{ url('frontend/images/ic_event.png') }}"
                          class="features-image"
                        />
                        <div class="description">
                          <h3>Featured Event</h3>
                          <p>{{ $travelPackage->featured_event }}</p>
                        </div>
                      </div>
                      <div class="col-md-4 border-left">
                        <img
                          src="{{ url('frontend/images/ic_bahasa.png') }}"
                          alt=""
                          class="features-image"
                        />
                        <div class="description">
                          <h3>Language</h3>
                          <p>{{ $travelPackage->language }}</p>
                        </div>
                      </div>
                      <div class="col-md-4 border-left">
                        <img
                          src="{{ url('frontend/images/ic_foods.png') }}"
                          alt=""
                          class="features-image"
                        />
                        <div class="description">
                          <h3>Foods</h3>
                          <p>{{ $travelPackage->foods }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card card-details card-right">
                <h2>Members are going</h2>
                <div class="members my-2">
                  @if($transaction)
                    @foreach($transaction->details as $detail)
                      <img
                          title="{{ $detail->user->username }}" 
                          src="{{ $detail->user->profile->image ? Storage::url($detail->user->profile->image) : asset('frontend/images/profiles/default.jpg') }}"  
                          class="rounded-circle"
                          style="width: 40px;" 
                      />
                    @endforeach

                    @else
                      <img
                          title="Who is going?" 
                          src="{{ asset('frontend/images/profiles/unknown.jpg') }}" 
                          class="rounded-circle"
                          style="width: 40px;" 
                      />
                  @endif
                </div>
                <hr />
                <h2>Trip Informations</h2>
                <table class="trip-informations">
                  <tr>
                    <th width="50%">Date of Departure</th>
                    <td width="50%" class="text-right">{{ Carbon\Carbon::create($travelPackage->departure_date)->format('F n, Y') }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Duration</th>
                    <td width="50%" class="text-right">{{ $travelPackage->duration }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Type</th>
                    <td width="50%" class="text-right">{{ $travelPackage->type }}</td>
                  </tr>
                  <tr>
                    <th width="50%">Price</th>
                    <td width="50%" class="text-right">${{ $travelPackage->price }} / person</td>
                  </tr>
                </table>
              </div>
              <div class="join-container">
                  @auth
                    @can('view', $travelPackage)

                      <a href="{{ route('checkout.index', $transaction->id) }}" class="btn btn-block btn-join-now mt-3 py-2 active">
                          You've already join this travel. <br>click to checkout!
                      </a>
                    
                      @else
  
                      <form action="{{ route('checkout.process', $travelPackage->id) }}" method="post">
                        @csrf
                        
                        <button type="submit" class="btn btn-block btn-join-now mt-3 py-2">
                          Join Now
                        </button>
                      </form>

                    @endcan
                  @endauth
                  @guest
                    <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                      Login to Join
                    </a>
                  @endguest
              </div>
            </div>
          </div>
      </div>
    </section>
  </main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/dist/xzoom.css')}}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/dist/xzoom.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({
            zoomWidth: 500,
            title: false,
            tint: '#333',
            Xoffset: 15
        });
    });
    </script>
@endpush