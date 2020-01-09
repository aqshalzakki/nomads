@extends('layouts.checkout')

@section('title', 'Checkout Travel')

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
                  Travel Package
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <a href="{{ route('travel-packages.detail', $transaction->travel_package->slug) }}">
                    Details
                  </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Checkout
                </li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 pl-lg-0">
            <div class="card card-details mb-3">
              <h1>Who is Going?</h1>
              <p>
                Trip to {{ $transaction->travel_package->title }}. {{ $transaction->travel_package->location }} 
              </p>
              @if(session()->has('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="attendee">
                <table class="table table-responsive-sm text-center">
                  <thead>
                    <tr>
                      <td scope="col">Picture</td>
                      <td scope="col">Name</td>
                      <td scope="col">Nationality</td>
                      <td scope="col">Visa</td>
                      <td scope="col">Passport</td>
                      <td scope="col"></td>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($transaction->details as $detail)
                      <tr>
                        <td>
                          <img
                            src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                            class="rounded-circle"
                            height="60"
                          />
                        </td>
                        <td class="align-middle">{{ $detail->username }}</td>
                        <td class="align-middle">{{ $detail->nationality }}</td>
                        <td class="align-middle">{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                        <td class="align-middle">
                          {{ \Carbon\Carbon::createFromDate($detail->doe_passport) > now() ? 'Active' : 'Inactive' }}
                        </td>
                        <td class="align-middle">
                          @if($detail->username != auth()->user()->username)
                            <form action="{{ route('checkout.remove', $detail->id) }}" method="post">
                             @csrf
                             @method('delete')
                                <button 
                                  onclick="return confirm('Are you sure you want to remove {{ $detail->username }} from this member list?')" 
                                  class="btn btn-link" 
                                  type="submit"
                                />
                                  <img src="{{ url('frontend/images/ic_remove.png')}}" />
                                </button>
                            </form>
                          @endif
                        </td>
                      </tr>
                      
                      @empty
                      
                      <tr>
                        <td colspan="6" class="text-center">
                          No Visitor
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="member mt-3">
                <h2>Add Member</h2>
                <form method="post" action="{{ route('checkout.create', $transaction->id) }}" class="form-inline">
                  @csrf
                  <label class="sr-only" for="username">Username</label>
                  <input
                    type="text"
                    class="form-control mb-2 mr-sm-2 @error('username') is-invalid @enderror"
                    style="width: 158px;"
                    id="username"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                  />
                  <label class="sr-only" for="nationality">Nationality</label>
                  <input
                    title="Nationality"
                    type="text"
                    class="form-control mb-2 mr-sm-2 @error('nationality') is-invalid @enderror"
                    id="nationality"
                    name="nationality"
                    placeholder="Nationality"
                    style="width: 106px;"
                    value="{{ old('nationality') }}"
                  />

                  <label
                    class="sr-only mr-2"
                    for="inlineFormCustomSelectPref"
                    >VISA</label
                  >
                  <select
                    class="custom-select mb-2 mr-sm-2 @error('is_visa') is-invalid @enderror"
                    id="inlineFormCustomSelectPref"
                    name="is_visa"
                  >
                    <option selected value="">VISA</option>
                    <option value="1">30 Days</option>
                    <option value="0">N/A</option>
                  </select>

                  <label class="sr-only" for="doePassport"
                    >DOE Passport</label
                  >
                  <div class="input-group mb-2 mr-sm-2">
                    <input 
                      autocomplete="0" 
                      type="text"
                      style="width: 140px;"
                      class="form-control datepicker @error('doe_passport') is-invalid @enderror"
                      id="doePassport"
                      placeholder="DOE Passport"
                      value="{{ old('doe_passport') }}"
                      name="doe_passport" 
                    />
                  </div>

                  <button type="submit" class="btn btn-add-now mb-2 px-4">
                    Add Now
                  </button>
                </form>
                <h3 class="mt-2 mb-0">Note</h3>
                <p class="disclaimer mb-0">
                  You are only able to invite member that has registered in
                  Nomads.
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-details card-right">
              <h2>Checkout Information</h2>
              <table class="trip-informations">
                <tr>
                  <th width="50%">Members</th>
                  <td width="50%" class="text-right">{{ $transaction->details->count() }}</td>
                </tr>
                <tr>
                  <th width="50%">Additional Visa</th>
                  <td width="50%" class="text-right">$ {{ $transaction->additional_visa }},00</td>
                </tr>
                <tr>
                  <th width="50%">Trip Price</th>
                  <td width="50%" class="text-right">$ {{ $transaction->travel_package->price }},00 / person</td>
                </tr>
                <tr>
                  <th width="50%">Sub Total</th>
                  <td width="50%" class="text-right">$ {{ $transaction->total }},00</td>
                </tr>
                <tr>
                  <th width="50%">Total (+Unique)</th>
                  <td width="50%" class="text-right text-total">
                    <span class="text-blue">$ 
                      {{ $transaction->total }},
                    </span>
                    <span class="text-orange">
                      {{ mt_rand(0, 99) }}
                    </span>
                  </td>
                </tr>
              </table>

              <hr />
              <h2>Payment Instructions</h2>
              <p class="payment-instructions">
                Please complete your payment before to continue the wonderful
                trip
              </p>
              <div class="bank">
                <div class="bank-item pb-3">
                  <img
                    src="{{ url('frontend/images/ic_bank.png')}}"
                    alt=""
                    class="bank-image"
                  />
                  <div class="description">
                    <h3>PT Nomads ID</h3>
                    <p>
                      0881 8829 8800
                      <br />
                      Bank Central Asia
                    </p>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="bank-item">
                  <img
                    src="{{ url('frontend/images/ic_bank.png')}}"
                    alt=""
                    class="bank-image"
                  />
                  <div class="description">
                    <h3>PT Nomads ID</h3>
                    <p>
                      0899 8501 7888
                      <br />
                      Bank HSBC
                    </p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
            <div class="join-container">
                <a
                  href="{{ route('checkout.success', $transaction->id) }}"
                  class="btn btn-block btn-join-now mt-3 py-2"
                  >I Have Made Payment
                </a>
            </div>
            <div class="text-center mt-3">
              <form action="{{ route('checkout.destroy', $transaction->id) }}" method="post">
                @csrf

                <button onclick="return confirm('Are you sure you want to cancel this booking?')" type="submit" class="text-muted btn btn-link">Cancel Booking</button>
              
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

@push('addon-script')

  <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js')}}"></script>
    <script>
      $(document).ready(function(){
        $('.datepicker').datepicker({
              format: 'yyyy-mm-dd',
              uiLibrary: 'bootstrap4',
              icons: {
                rightIcon: '<img src="{{ url('frontend/images/ic_doe.png')}}" alt="" />'
              }
            });
      })
    </script>

@endpush