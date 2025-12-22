<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Warehouse;
use App\Services\SaleService;
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
        ->addColumn('price', function ($row) {
            return $row->product_id ? $row->product->price : '-';
        })
        ->addColumn('warehouse', function ($row) {
            return $row->warehouse ? $row->warehouse->name : '-';
        })
        ->addColumn('quantity', fn($product) => $product->quantity ?? 0)
        ->addColumn('action', fn($row) => view('lookups.action', ['type'=>'sales','model' => $row])->render())
        ->rawColumns(['action'])
        ->make(true);

    }
    public function show(Sale $sale){
        $this->authorize('view',$sale);
        $data = [
            'Product Name'=>$sale->product->name,
            'Product Price'=>$sale->product->price,
            'Sold From Warehouse'=>$sale->warehouse->name,
            'Quantity Sold'=>$sale->quantity,
            'Total Amount'=>$sale->total_amount,

            'Transaction Date'=>$sale->sale_date,

        ];
        return view('lookups.show',['datas'=>$data]);
    } 

    public function create(){
        $products = Product::where('status',1)->pluck('name','id');
        // $warehouses = Warehouse::where('status',1)->pluck('name','id');

        return view('sales.create',['products'=>$products]);
    }
    public function store(StoreSaleRequest $request, SaleService $saleService){
        $this->authorize('create', Sale::class);
        try {
            $saleService->create_sale($request->validated());
            return redirect()->back()->with('success','Sale Created successfully');

        } catch (\Throwable $th) {
            return back()->withErrors(['db_error' => $e->getMessage()])->withInput();
            //throw $th;
        }
    }
}
