@extends('layouts.admin')

@section('title', "Transaction Detail")

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaction Detail from <b>{{ $transaction->user->username }}</b></h1>
    </div>


    <div class="card-shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $transaction->id }}</td>
                </tr>
                <tr>
                    <th>Travel Package</th>
                    <td>{{ $transaction->travel_package->title }}</td>
                </tr>
                <tr>
                    <th>Departure Date</th>
                    <td>{{ Carbon\Carbon::create($transaction->travel_package->departure_date)->format('d F, Y') }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $transaction->user->username }}</td>
                </tr>
                <tr>
                    <th>Additional Visa</th>
                    <td>${{ $transaction->additional_visa }}</td>
                </tr>
                <tr>
                    <th>Transaction Total</th>
                    <td>${{ $transaction->total }}</td>
                </tr>
                <tr>
                    <th>Transaction Status</th>
                    <td>{{ $transaction->status->name }}</td>
                </tr>
                <tr>
                    <th>Purchase</th>
                    <td>
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Nationality</th>
                                <th>Visa</th>
                                <th>DOE Passport</th>
                            </tr>
                            @foreach($transaction->details as $detail)
                                <tr>
                                    <td>{{ $detail->id }}</td>
                                    <td>{{ $detail->username }}</td>
                                    <td>{{ $detail->nationality }}</td>
                                    <td>{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                    <td>{{ $detail->doe_passport }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection