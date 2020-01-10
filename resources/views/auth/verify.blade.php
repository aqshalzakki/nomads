@extends('layouts.app')

@section('title', 'Verify your email address')
@section('content')
<div class="container">
    <div class="row justify-content-center my-5 py-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>

                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {!! session('message') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('resent'))
                        <div class="alert alert-primary" role="alert">
                            A fresh verification link has been sent to your email address.
                        </div>
                    @endif

                    Please check your email for a verification link.
                    If you did not receive the email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
