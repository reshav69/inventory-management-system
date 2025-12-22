<?php

namespace App\Http\Controllers;

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{

    /**
     * in controller
     * 1.policy check
     * 2.admin CRUD
     * 3.staff edit,view
     * 
     */

    public function index()
    {
        $this->authorize('viewAny', Product::class);

        // $products = Product::all();
        return view('lookups.index', [
            'title' => 'View Products',
            'dataUrl'   => route('products.data'),
            'type'   => 'products',
            'columns'=>['Name','Status','Price','Quantity'],
            'columnsConfig'   => [
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'price', 'name' => 'price'],
                ['data' => 'quantity', 'name' => 'quantity'],
            ],
        ]);

    }

    public function data(){
        return DataTables::of(
            Product::withSum('warehouseStocks as quantity', 'quantity')->orderBy('id','desc')
        )
        ->addIndexColumn()
        ->addColumn('quantity', fn($product) => $product->quantity ?? 0)
        ->addColumn('action', fn($row) => view('lookups.action', ['type'=>'products','model' => $row])->render())
        ->editColumn('status', fn($row) => $row->status
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>')
        ->rawColumns(['status','action'])
        ->make(true);

    }


    public function warehouses(Product $product)
    {
        $this->authorize('viewAny', Product::class);
        $warehouses = $product->warehouseStocks()
            ->where('quantity', '>', 0)
            ->with('warehouse:id,name')
            ->get()
            ->map(function ($stock) {
                return [
                    'id' => $stock->warehouse->id,
                    'name' => $stock->warehouse->name,
                    'quantity' => $stock->quantity,
                ];
            });

        return response()->json($warehouses);
    }

    // public function getProductCount($id){
    //     $product = Product::where('id',$id)->first();
    //     $availableQuantity = $product->quantity;

    //     $totalUsed = StockTransaction::where('product_id', $id)
    //                         ->sum('quantity');
    //     $remainingQuantity =  $availableQuantity - $totalUsed;

    //     return response()->json([
    //         'total_quantity' => $availableQuantity,
    //         'remaining_quantity' => $remainingQuantity
    //     ]);
        
    // }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('admin.products.create');
    }


    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', Product::class);

        try {
            $data = $request->validated();
            // dd($data);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('products', 'public');
                $data['image_path'] = $path;
            }
            Product::create($data);

            return back()->with('success', 'Product created successfully.');

        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->withErrors(['db_error'=>'Failed adding product']);
        }
        
    }

    /**
     * Display the specified resource. (view)
     * Accessible by: Admin, Staff (Anyone authenticated)
     */
    public function show(Product $product)
    {
        // 2. Policy Check: view
        $this->authorize('view', $product);
        $data = [
            'ID'=>$product->id,
            'Name'=>$product->name,
            'Status'=>$product->status,
            'Description'=>$product->description,
            'Image'=>$product->image_path,
            'Barcode'=>$product->barcode,
            'Created_by'=>$product->createdBy->email,
            'Created_at'=>$product->created_at,
            'Updated_at'=>$product->updated_at,
            'Updated_by'=>$product->updatedBy->email ?? '-',

        ];

        return view('lookups.show', ['datas'=>$data]);

        // return view('lookups.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource. (update)
     * Accessible by: Admin, Staff
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('admin.products.edit', compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        try {
            //code...
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                    Storage::disk('public')->delete($product->image_path);
                }
    
                $path = $request->file('image')->store('products', 'public');
                $data['image_path'] = $path;
            }

            $product->update($data);
            return back()->with('success', 'Product updated successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(['db_error','Failed to update']);
        }
    }


    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        try {
            //code...
            $product->delete();
            return back('lookups.index')->with('success', 'Product deleted successfully.');
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
    
}