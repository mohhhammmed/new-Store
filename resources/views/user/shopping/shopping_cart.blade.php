




<img class="cart"  src="{{asset('user/icons/shopping-cart.png')}}">
@isset(App\Models\ShoppingCart::where('subcategory_id',$subcategory->id)->first()->count)
    @if(App\Models\ShoppingCart::where('subcategory_id',$subcategory->id)->first()->count < $subcategory->subcategory_num)
        <a type="checkbox" class="shoppingCart"
        href="{{route('shopping_cart',$subcategory->id)}}"
        get_id="{{$subcategory->id}}">Add to cart</a>
    @else
        {{'Not Available'}}
    @endif
@elseif($subcategory->subcategory_num > 0)
        <a type="checkbox" class="shoppingCart"
        href="{{route('shopping_cart',$subcategory->id)}}"
        get_id="{{$subcategory->id}}">Add to cart</a>
@else
       {{'Not Available'}}
@endisset

<div id='{{'addToCart'.$subcategory->id}}'>

 </div>
