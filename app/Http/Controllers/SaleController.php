<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\Sale;
use App\Services\SaleService;
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
            'columns'=>['Product','Warehouse','Price','Quantity','Total','Sale Date','Status'],
            'columnsConfig'   => [
                ['data' => 'product', 'name' => 'product.name'],
                ['data' => 'warehouse', 'name' => 'warehouse.name'],
                ['data' => 'price', 'name' => 'price'],
                ['data' => 'quantity', 'name' => 'quantity'],
                ['data' => 'total_amount', 'name' => 'total_amount'],
                ['data'=>'sale_date','name'=>'sale_date'],
                ['data'=>'status','name'=>'status'],
            ],
        ]);

    }
    public function data(){
        return DataTables::of(Sale::query()->with('product','warehouse')->orderBy('sale_date','desc'))
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
        ->editColumn('status', fn($row) => $row->status === 'refunded'
            ? '<span class="badge bg-danger">Refunded</span>'
            : '<span class="badge bg-success">Completed</span>')
        ->addColumn('quantity', fn($product) => $product->quantity ?? 0)
        ->addColumn('action', fn($row) => view('lookups.action', ['type'=>'sales','model' => $row])->render())
        ->rawColumns(['status','action'])
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

            'Sale Date'=>$sale->sale_date,
            'Sales Status'=>$sale->status=== 'completed'?'<span class="badge bg-success">Completed</span>':
            '<span class="badge bg-danger">Refunded</span>',
            'Created by'=>$sale->createdBy->email

        ];
        return view('lookups.show',['datas'=>$data]);
    } 

    public function create(){
        $products = Product::where('status',1)->pluck('name','id');
        // $warehouses = Warehouse::where('status',1)->pluck('name','id');

        return view('sales.create',['products'=>$products,'title'=>'Sell Product']);
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
    
    public function edit(Sale $sale){
        $this->authorize('update', $sale);
        
        return view('sales.edit', compact('sale'));
        
    }
    public function update(UpdateSaleRequest $request,Sale $sale){
        $this->authorize('update', $sale);

        if ($sale->status === 'refunded') {
            return back()->withErrors([
                'db_error' => 'Sale already refunded, cannot edit.',
            ]);
        }

        try {
            $sale->update($request->validated());

            return back()->with('success', 'Details updated successfully');
        } catch (\Throwable $e) {
            return back()->withErrors(['db_error' => 'Update failed'])->withInput();
        }

    }
    public function refund(SaleService $saleService, Sale $sale)
    {
        $this->authorize('update', $sale);

        if ($sale->status === 'refunded') {
            return back()->withErrors([
                'db_error' => 'Sale already refunded.',
            ]);
        }

        $input = $sale->only([
            'product_id',
            'warehouse_id',
            'quantity',
            'customer_full_name',
            'customer_phone_number',
            'customer_extra_info',
        ]);

        try {
            $saleService->refund($sale);

            return redirect()->route('sales.create')->with('success', 'Refunded sale successfully')->withInput($input);

        } catch (\Throwable $e) {
            return back()->withErrors(['db_error' => 'Failed to refund the sale'])->withInput();
        }
    }

}
