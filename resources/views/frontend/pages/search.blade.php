@extends('layouts.app')

@section('title', 'Search Products')

@section('content')


<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4>Search Results</h4>
                <div class="underline mb-4">      
                </div>
            </div>
                @forelse ($searchProduct as $product)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>
                                        @if ($product->productImages->count(0))
                                            <a
                                                href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                                <img src="{{ asset($product->productImages[0]->image) }}"
                                                    alt="{{ $product->name }}">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $product->brand->name }}</p>
                                        <h5 class="product-name">
                                            <a
                                                href="{{ url('/collections/'.$product->category->slug.'/'. $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{ $product->selling_price }}</span>
                                            <span class="original-price">{{ $product->original_price }}</span>
                                        </div>
                                        <p style="height: 45px;">
                                        <b>Description : </b> {{$product->description}}
                                        </p>
                                        <a href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}" 
                                            class="btn btn-outline-primary ">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Such Products found</h4>
                    </div>
                @endforelse

                <div>
                    {!! $searchProduct->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
        </div>
    </div>
</div>
@endsection
