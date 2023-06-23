@extends('layouts.admin')

@section('title', ' My Order')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3> My Orders
                    
                    </h3>
                </div>
                <div class="card-body">


                        <form action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Filter By Date</label>
                                    <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                                </div>
                            <div class="col-md-3">
                                <label>Filter By Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="in progress" {{Request::get('status') == 'in progress' ? 'selected': ''}}>In Progress</option>
                                    <option value="completed" {{Request::get('status') == 'completed' ? 'selected': ''}}>Completed</option>
                                    <option value="pending" {{Request::get('status') == 'pending' ? 'selected': ''}}>Pending</option>
                                    <option value="cancelled" {{Request::get('status') == 'cancelled' ? 'selected': ''}}>Cancelled</option>
                                    <option value="out-for-delivery" {{Request::get('status') == 'out-for-delivery' ? 'selected': ''}}>Out for Delivery</option>
                                </select>
                            </div>      
                            <div class="col-md-6">
                                <br/>
                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            </div>
                            </div>
                        </form>

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
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->tracking_no }}</td>
                                        <td>{{ $order->full_name }}</td>
                                        <td>{{ $order->payment_mode }}</td>
                                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $order->status_message }}</td>
                                        <td><a href="{{ url('admin/orders/view/'.$order->id) }}" class="btn btn-primary btn-sm">view</a>
                                        </td>
                                    </tr>
                                @empty
                                    <td collspan="7">No Orders Available</td>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="py-3">

                            {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
