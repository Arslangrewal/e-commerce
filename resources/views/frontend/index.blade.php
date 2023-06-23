@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }} ">
                    @if ($sliderItem->image)
                        <img class="d-block w-100" src="{{ asset("$sliderItem->image") }}" alt="First slide">
                    @endif

                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                <h5>{{ $sliderItem->title }}</h5>
                            </h1>
                            <p>
                                {{ $sliderItem->description }}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>New Products Stock </h4>
                    <div class="underline mx-auto"></div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Veniam itaque laborum eaque velit excepturi omnis officiis reiciendis error libero
                        amet dolorum sapiente eum fugit, quia, aut laudantium voluptatibus dolores reprehenderit!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline mb-4">

                    </div>
                </div>
                @if ($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                        
                                @foreach ($trendingProducts as $product)
                                    <div class="item">
                                        <div class="product-card">
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
                                            <div class="product-card-body">
                                                <p class="product-brand">{{ $product->brand->name }}</p>
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <span class="selling-price">{{ $product->selling_price }}</span>
                                                    <span class="original-price">{{ $product->original_price }}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    @else
                        <div class="col-md-12">
                            <div class="p-2">
                                <h4>No Products available</h4>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>New Arrivals</h4>
                    <div class="underline mb-4">

                    </div>
                </div>
                @if ($newArrivalProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                        
                                @foreach ($newArrivalProducts as $product)
                                    <div class="item">
                                        <div class="product-card">
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
                                            <div class="product-card-body">
                                                <p class="product-brand">{{ $product->brand->name }}</p>
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ url('/collections/' . $product->category->slug . '/' . $product->slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <span class="selling-price">{{ $product->selling_price }}</span>
                                                    <span class="original-price">{{ $product->original_price }}</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    @else
                        <div class="col-md-12">
                            <div class="p-2">
                                <h4>No New Arrivals available</h4>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('script')

    <script>
        $('.four-carousel').owlCarousel({
            loop: true,
            margin: 10,
            dots:true,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>


@endsection
