<div>
    <div class="py-3 py-md-5">
        <div class="container">
         
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)

                            <div class="exzoom" id="exzoom">
                                <!-- Images -->
                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($product->productImages as $itemimg)
                                            <li><img src="{{ asset($itemimg->image) }}" /></li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                                        < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            No Image added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }}

                        </h4>
                        <hr>
                        <p class="product-path">

                            {{ $product->category->name }} / {{ $product->slug }}

                        </p>
                        <div>
                            <span class="selling-price">{{ $product->selling_price }}</span>

                            <span class="original-price">{{ $product->original_price }}</span>
                        </div>
                        <div>
                            @if ($product->productColors)
                                @foreach ($product->productColors as $coloritem)
                                    <label class="colorSelectionLable"
                                        style="background-color : {{ $coloritem->color->code }}"
                                        wire:click="colorSelected({{ $coloritem->color->id }})">
                                        {{ $coloritem->color->name }}
                                    </label>
                                @endforeach
                            @endif

                            @if ($prodColorSelectedQty == 'outOfStock')
                                <label class="btn-sm py-1 mt-2 text-white bg-danger"> Out of Stock </label>
                            @elseif ($prodColorSelectedQty > 0)
                                <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                            @endif


                            @if ($product->quantity)
                                <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                            @else
                                <label class="btn-sm py-1 mt-2 text-white bg-danger"> Out of Stock </label>
                            @endif

                        </div>

                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decreamentQty"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                    class="input-quantity" />
                                <span class="btn btn1" wire:click="increamentQty"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                    </div>


                    <div class="mt-2">
                        <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1"
                            style="border: 1px solid black">
                            <i class="fa fa-shopping-cart"></i> Add To Cart
                        </button>

                        <button type="button" wire:click="addToWishlist({{ $product->id }})" class="btn btn-primary"
                            style="border: 1px solid black">
                            <span wire:loading.remove wire:target="addToWishlist">
                                <i class="fa fa-heart"></i>Add To Wishlist</button>
                        </span>
                        <span wire:loading wire:target="addToWishlist">Adding...</span>
                    </div>

                    <div class="mt-3">
                        <h5 class="mb-0">Description</h5>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Meta Description</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $product->meta_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related 
                        @if ($category) {{$category->name}} @endif
                        Products</h3>
                    <div class="underline"></div>
                </div>

                @forelse ($category->products as $relatedproduct)
                    <div class="col-md-3 mb-3">
                        <div class="product-card">
                            <div class="product-card-img">

                                <label class="stock bg-danger">New</label>


                                @if ($relatedproduct->productImages->count(0))
                                    <a
                                        href="{{ url('/collections/' . $relatedproduct->category->slug . '/' . $relatedproduct->slug) }}">
                                        <img src="{{ asset($relatedproduct->productImages[0]->image) }}"
                                            alt="{{ $relatedproduct->name }}">
                                    </a>
                                @endif

                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $relatedproduct->brand->name }}</p>
                                <h5 class="product-name">
                                    <a
                                        href="{{ url('/collections/' . $relatedproduct->category->slug . '/' . $relatedproduct->slug) }}">
                                        {{ $relatedproduct->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{ $relatedproduct->selling_price }}</span>
                                    <span class="original-price">{{ $relatedproduct->original_price }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Products available</h4>
                    </div>
            @endforelse
            </div>
        </div>
    </div>

</div>
</div>

@push('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({
                
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000

            });

        });
    </script>
@endpush
