<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

use App\Category;

use App\Cart;

use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    public function index()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $data = [];
        $items = Item::orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::get();
        $data = ['items'=>$items, 'categories'=>$categories];
        return view('welcome', $data);
        
    }
    
    public function show($itemId)
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $item = Item::findOrFail($itemId);
        $user = \Auth::user();
        $categories = Category::pluck('category_name', 'id');

        return view('items.show', ['item'=>$item, 'categories'=>$categories]);
    }
    
   public function category($catgoryId)
   {
       $data = [];
       $category = Category::findOrFail($catgoryId);
       $categories = Category::get();
       $category_items = $category->items()->orderBy('created_at', 'desc')->paginate(6);
       $data = ['categories'=>$categories, 'category_items'=>$category_items, 'category'=>$category];
       return view('categoryIndex.categoryIndex', $data);
   }
   
   public function showAddProduct()
   {
       $categories = Category::pluck('category_name', 'id');
       return view('admin.admin_add_product', ['categories'=>$categories]);
   }
   
   public function addProduct(Request $request)
   {
    //   dd($request);
       $request->validate([
            'item_title' => 'required|max:30',
            'content' => 'required|max:255',
            'item_quantity' => 'required',
            'image' => 'required|image',
            'price' => 'required',
        ]);
        
       $file = $request->file('image');
       $path = Storage::disk('s3')->putFile('/', $file, 'public');
    //   $image_url = Storage::disk('s3')->url($path);
       
       
       Item::create([
          'item_title' => $request->item_title,
          'category_id' => $request->category_id,
          'content' => $request->content,
          'item_quantity' => $request->item_quantity,
          'price' => $request->price,
          'image_url' => $path,
        ]);
    
       return redirect('/');

   }
   
//   public function upload(Request $request, $itemId)
//   {
//       $image = $request->file('file');
//       // 第一引数はディレクトリの指定
//       // 第二引数はファイル
//         // 第三引数はpublickを指定することで、URLによるアクセスが可能となる
//       $path = Storage::disk('s3')->putFile('/', $image, 'public');
//         // hogeディレクトリにアップロード
//         // $path = Storage::disk('s3')->putFile('/hoge', $file, 'public');
//         // ファイル名を指定する場合はputFileAsを利用する
//         // $path = Storage::disk('s3')->putFileAs('/', $file, 'hoge.jpg', 'public');
//   }
   
   public function update(Request $request, $itemId)
   {
    //   dd($request->file('image'));
       $request->validate([
            'item_title' => 'required|max:30',
            'content' => 'required|max:255',
            'item_quantity' => 'required',
            'image' => 'image',
            'price' => 'required',
        ]);
       
       $item = Item::findOrFail($itemId);
       
       if($request->has('image')){
           Storage::disk('s3')->delete($item->image_url);
           $file = $request->file('image');
           $path = Storage::disk('s3')->putFile('/', $file, 'public');
        //   $image_url = Storage::disk('s3')->url($path);
       }
       
       
       $item->update([
          'item_title' => $request->item_title,
          'category_id' => $request->category_id,
          'content' => $request->content,
          'item_quantity' => $request->item_quantity,
          'price' => $request->price,
          'image_url' => ($request->has('image')) ? $path : $item->image_url,
        ]);

       return back();
   }
   
   public function destroy($itemId)
   {
       $item = Item::findOrFail($itemId);
       Storage::disk('s3')->delete($item->image_url);
       $item->delete();
       return redirect('/');
   }
   
   
   public function searchIndex(Request $request){
    //   dd($request);
        $request->validate([
           'keyword' => 'required|max:20'
           ]);
        
           
        $keyword = $request->keyword;

        $items = Item::where('item_title', 'like', '%'."$keyword".'%')
                 ->orWhere('content', 'like', '%'."$keyword".'%')
                 ->where('item_quantity', '>', 0)
                 ->orderBy('created_at', 'desc')
                 ->paginate(6);
       
       return view('items.searchItems', ['items'=>$items, 'keyword'=>$keyword]);
   }
   
}
