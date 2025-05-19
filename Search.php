<<<<<<< HEAD
// In Product model
use Laravel;

class Product extends Model
{
    use Searchable;
    
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category->name,
        ];
    }
}

// In controller
public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::search($query)->get();
    
    return view('search.results', compact('products', 'query'));
=======
// In Product model
use Laravel;

class Product extends Model
{
    use Searchable;
    
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category->name,
        ];
    }
}

// In controller
public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::search($query)->get();
    
    return view('search.results', compact('products', 'query'));
>>>>>>> Surya_Branch
}