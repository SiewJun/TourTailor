
@extends('layouts.layout') 

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payment Success</div>

                    <div class="card-body">
                        <p>Your payment was successful!</p>
                        <p>Total Amount: RM{{ number_format($totalAmount, 2) }}</p>
                        {{-- Add any other relevant details or thank you message --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
