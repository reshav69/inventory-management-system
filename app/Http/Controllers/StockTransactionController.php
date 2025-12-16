<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockTransactionRequest;
use App\Http\Requests\UpdateStockTransactionRequest;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Warehouse;
use App\Services\StockTransactionService;
use Yajra\DataTables\DataTables;


class StockTransactionController extends Controller
{
    public function index(){
        $this->authorize('viewAny', StockTransaction::class);


        return view('lookups.index', [
            'title' => 'View Stock Transactions',
            'dataUrl'   => route('stocktransactions.data'),
            'type'   => 'stocktransactions',
            'columns'=>['Product','Warehouse','Quantity','Transaction','Date'],
            'columnsConfig'   => [
                ['data' => 'product', 'name' => 'product'],
                ['data' => 'warehouse', 'name' => 'warehouse'],
                ['data' => 'quantity', 'name' => 'quantity'],
                ['data' => 'transaction_type', 'name' => 'transaction_type'],
                ['data' => 'transaction_date', 'name' => 'transaction_date'],

            ],
        ]);

    }
    public function data(){
        $this->authorize('viewAny', StockTransaction::class);
        return DataTables::of(StockTransaction::with('product','warehouse'))
        ->addIndexColumn()
        ->addColumn('product', function ($row) {
            return $row->product_id ? $row->product->name : '-';
        })
        ->addColumn('warehouse', function ($row) {
            return $row->warehouse ? $row->warehouse->name : '-';
        })
        ->addColumn('action', function($row){
            return view('lookups.action', ['type'=>'stocktransactions','model' => $row])->render();
        })
        ->editColumn('status', fn($row) => $row->status? '<span class="badge bg-success">Active</span>' :
             '<span class="badge bg-danger">Inactive</span>')
        ->rawColumns(['status','action'])
        ->make(true);
    }

    public function show($id){
        $stocktransaction = StockTransaction::With('product','warehouse')->findOrFail($id);

        $data = [
            'ID'=>$stocktransaction->id,
            'Quantity'=>$stocktransaction->quantity,
            'Product'=>"{$stocktransaction->product->name}",
            'Warehouse'=>$stocktransaction->warehouse->name,
            'TransactionType'=>$stocktransaction->transaction_type,
            'Transaction Date'=>$stocktransaction->transaction_date,

        ];
        return view('lookups.show',['datas'=>$data]);
    }

    public function create(){
        $products = Product::where('status',1)->pluck('name','id');
        $warehouses = Warehouse::where('status',1)->pluck('name','id');
        return view('admin.stocktransactions.create',['products'=>$products,'warehouses'=>$warehouses]);

    }
    public function store(StoreStockTransactionRequest $request,StockTransactionService $service){
        $this->authorize('create', StockTransaction::class);
        try {
            $data = $request->validated();
            // dd($data);
            $service->handle($data);
            // StockTransaction::create($data);
            return back()->with('success','Added successfully');
        } catch (\Throwable $th) {
            //throw $th;
            // $th->getMessage();
            dd($th->getMessage());
            // return back()->withErrors(['db_error'=>'Something went wrong']);
            // return back()->withErrors(['db_error'=>$th->getMessage()]);
        }

    }
    public function edit(StockTransaction $stocktransaction){

    }

    public function update(UpdateStockTransactionRequest $request,StockTransaction $stocktransaction){



    }

    public function destroy(StockTransaction $stocktransaction){

    }
}
