@extends('layouts.master')
@section('page_title', 'Create Order')
@section('content')

    <a href="{{ route('orders.index') }}" class="btn btn-light float-right">
        <i class="fa fa-arrow-circle-left"></i> Back To Orders History</a>
    <h3>Create Order</h3>
    <hr>
    <form method="post" action="{{ route('orders.store') }}" id="order-form" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount"
                value="{{ old('amount') }}">
            @include('errors.validation-error', ['formField' => 'amount'])
        </div>
        <div class="form-group">
            <label for="currency">Select currency:</label>
            <select class="form-control" id="currency" name="currency">
                <option value="" disabled selected>-Please Select-</option>
                @foreach ($currencies as $currency)
                    <option {{ old('currency') == $currency ? 'selected' : '' }}>{{ $currency }}</option>
                @endforeach
            </select>
            @include('errors.validation-error', ['formField' => 'currency'])
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                value="{{ old('email') }}">
            @include('errors.validation-error', ['formField' => 'email'])
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('javascript')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {

            let validCurrencies = @json(config('constants.CURRENCIES'));

            // MAKE CUSTOM VALIDATOR FOR VALID CURRENCIES
            jQuery.validator.addMethod("validCurrencies", function(value, element) {
                if ($.inArray(value, validCurrencies) > -1) {
                    return true;
                } else {
                    return false;
                };
            }, "Invalid currency");

            // VALIDATE FORM
            $('#order-form').validate({ // initialize the plugin
                rules: {
                    amount: {
                        required: true,
                        min: 1,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    currency: {
                        required: true,
                        validCurrencies: true,
                    },
                },
                messages: {
                    amount: {
                        required: 'The amount field is required',
                        min: 'The amount must be greater than or equal to 1 and must be an integer',
                    },
                    email: {
                        required: 'The email field is required',
                    },
                    currency: {
                        required: 'The currency field is required',
                    },
                }
            });
        });
    </script>
@endsection
