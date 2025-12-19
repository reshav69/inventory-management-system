<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Sale::class);

        // $products = Product::all();
        return view('lookups.index', [
            'title' => 'View Sales',
            'dataUrl'   => route('sales.data'),
            'type'   => 'sales',
            'columns'=>['Product','Warehouse','Price','Quantity','Total'],
            'columnsConfig'   => [
                ['data' => 'product', 'name' => 'product'],
                ['data' => 'warehouse', 'name' => 'warehouse'],
                ['data' => 'price', 'name' => 'price'],
                ['data' => 'quantity', 'name' => 'quantity'],
                ['data' => 'total_amount', 'name' => 'total_amount'],
            ],
        ]);

    }
    public function data(){
        return DataTables::of(Sale::query()->with('product','warehouse'))
        ->addIndexColumn()
        ->addColumn('product', function ($row) {
            return $row->product_id ? $row->product->name : '-';
        })
        ->addColumn('warehouse', function ($row) {
            return $row->warehouse ? $row->warehouse->name : '-';
        })
        ->addColumn('quantity', fn($product) => $product->quantity ?? 0)
        ->addColumn('action', fn($row) => view('lookups.action', ['type'=>'sales','model' => $row])->render())
        ->rawColumns(['action'])
        ->make(true);

    }
    public function show(){

    } 

    public function create(){
        $products = Product::where('status',1)->pluck('name','id');
        // $warehouses = Warehouse::where('status',1)->pluck('name','id');

        return view('sales.create',['products'=>$products]);
    }
    public function store(StoreSaleRequest $request){
        $this->authorize('create', Sale::class);
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
