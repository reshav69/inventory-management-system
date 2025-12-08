<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
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
            'columns'   => [
                ['name' => 'id', 'label' => 'ID'],
                ['name' => 'name', 'label' => 'Name'],
                ['name' => 'status', 'label' => 'Status'],
                ['name' => 'price', 'label' => 'Price'],
                ['name' => 'quantity', 'label' => 'Quantity'],
                // ['name' => 'barcode', 'label' => 'Barcode'],
            ],
        ]);
        // return view('products.index', compact('products'));
    }

    public function data(){
        return DataTables::of(Product::query())
        ->addColumn('action', function($row){
            return view('lookups.action', ['type'=>'products','model' => $row])->render();
        })
        
        ->editColumn('status', fn($row) => $row->status? '<span class="badge bg-success">Active</span>' :
             '<span class="badge bg-danger">Inactive</span>')
        ->rawColumns(['status','action'])
        ->make(true);

        // return DataTables::of(Product::query())
        //     ->addColumn('action', function($row){
        //         return view('lookups.action', ['id'=>$row->id, 'type'=>'products'])->render();
        //     })
        //     ->addColumn('created_by',fn($row)=>$row->createdBy->name)
        //     ->addColumn('updated_by',fn($row)=>$row->updatedBy->name ??  '-')
        //     ->editColumn('created_at', fn($row) => $row->created_at? $row->created_at->format('d M, Y H:i') : '')
        //     ->editColumn('updated_at', fn($row) => $row->updated_at? $row->updated_at->format('d M, Y H:i') : '')
        //     ->rawColumns(['status','action'])
        //     ->make(true);
    }

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

        return view('lookups.show', ['datas'=>$product->toShowData()]);

        // return view('lookups.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource. (update)
     * Accessible by: Admin, Staff
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('products.edit', compact('product'));
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