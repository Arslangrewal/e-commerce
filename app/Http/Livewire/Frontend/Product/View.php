<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{

    public $category, $product, $prodColorSelectedQty, $quantityCount = 1, $prodColorId;


    public function addToWishlist($productId)
    {

        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                // session()->flash('message', 'Wishlist added successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
            }
        } else {
            session()->flash('message', 'Please log in to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please log in to continue',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function increamentQty()
    {

        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function decreamentQty()
    {

        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function colorSelected($prodColorId)
    {

        $this->prodColorId = $prodColorId;
        $prodColor = $this->product->productColors()->where('color_id', $prodColorId)->first();
        // dd($prodColor);
        $this->prodColorSelectedQty = $prodColor->quantity;

        if ($this->prodColorSelectedQty == 0) {
            $this->prodColorSelectedQty = 'outOfStock';
        }
    }
    public function mount($category, $product)
    {

        $this->category = $category;
        $this->product = $product;
    }

    public function addToCart(int $productId)
    {

        if (Auth::check()) {

            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {

                if ($this->product->productColors()->count() > 1) {

                    if ($this->prodColorSelectedQty != NULL) {
                        // dd('color selected');
                        if (Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->prodColorId)
                            ->exists()
                        ) {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product already added',
                                'type' => 'warning',
                                'status' => 200
                            ]);
                        } else {
                            $prodColor = $this->product->productColors()->where('color_id', $this->prodColorId)->first();

                            if ($prodColor->quantity > 0) {

                                if ($prodColor->quantity >= $this->quantityCount) {

                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->prodColorId,
                                        'quantity' => $this->quantityCount
                                    ]);

                                    $this->emit('CartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product added to Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only' . $prodColor->quantity . 'quantity a vailable',
                                        'type' => 'warning',
                                        'status' => 409
                                    ]);
                                }
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Out of Stock',
                                    'type' => 'error',
                                    'status' => 409
                                ]);
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select your product color',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                } else {
                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {

                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product already added',
                            'type' => 'warning',
                            'status' => 200
                        ]);
                    }
                }
            } else {

                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exist',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please log in to add to cart',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }


    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
