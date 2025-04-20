// CartController.php
public function addToCart(Request $request, Product $product)
{
    $cart = session()->get('cart', []);
    
    if(isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->images->first()->path ?? null
        ];
    }
    
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart!');
}