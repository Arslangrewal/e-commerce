<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCounter extends Component
{
    public $cartCount;

    public function checkCartCount(){
        if(Auth::check()){
            return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        }
        else
        {
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.frontend.cart.cart-counter',[
            'cartCount' => $this->cartCount
        ]);
        
    }
}
