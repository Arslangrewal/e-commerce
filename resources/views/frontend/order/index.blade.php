@extends('layouts.app')

@section('title', 'Order')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">

                        <h4 class="mb-4">My Orders</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No</th>
                                        <th>User Name</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Data</th>
                                        <th>status message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->tracking_no}}</td>
                                            <td>{{$order->full_name}}</td>
                                            <td>{{$order->payment_mode}}</td>
                                            <td>{{$order->created_at->format('d-m-Y')}}</td>
                                            <td>{{$order->status_message}}</td>
                                            <td><a href="{{url('order/'.$order->id)}}" class="btn btn-primary btn-sm">view</a></td>
                                        </tr>
                                    @empty
                                        <td collspan="7">No Orders Available</td>
                                    @endforelse
                                </tbody>
                            </table>
                            <div> 
                                {{-- {{ $orders->links() }} --}}
                                {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
