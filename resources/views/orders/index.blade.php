@extends('layouts.master')
@section('page_title', 'Orders History')
@section('content')
    <a href="{{ route('orders.create') }}" class="btn btn-success float-right">Create New Order</a>
    <h3>Orders History</h3>
    <hr>
    <table id="example" class="table table-striped table-bordered datatable" style="width:100%">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>State</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ number_format((float) $order->amount, 2, '.', '') }}</td>
                    <td>{{ $order->currency }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ date('Y/m/d h:i A', strtotime($order->created_at)) }} (GMT)</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" align="center">
                        No orders are available
                    </td>
                </tr>
            @endforelse
    </table>
@endsection
