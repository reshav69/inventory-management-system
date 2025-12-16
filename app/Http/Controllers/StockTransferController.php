<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\StockTransfer;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;


class StockTransferController extends Controller
{
    public function index(){
        $this->authorize('viewAny', StockTransfer::class);


        return view('lookups.index', [
            'title' => 'View Stock Transfers',
            'dataUrl'   => route('stocktransfers.data'),
            'type'   => 'stocktransfers',
            'columns'=>['Product','From Warehouse','To Warehouse','Quantity','Date'],
            'columnsConfig'   => [
                ['data' => 'product', 'name' => 'product'],
                ['data' => 'from_warehouse', 'name' => 'from_warehouse'],
                ['data' => 'to_warehouse', 'name' => 'to_warehouse'],
                ['data' => 'quantity', 'name' => 'quantity'],
                ['data' => 'transfer_date', 'name' => 'transfer_date'],

            ],

        ]);
    }
    public function create(){

    }

    public function data(){
        return DataTables::of(StockTransfer::query())->addIndexColumn()
        ->addColumn('action', function($row){
            return view('lookups.action', ['type'=>'stocktransfers','model' => $row])->render();
        })
        ->addColumn('product', function ($row) {
            return $row->product_id ? $row->product->name : '-';
        })
        ->addColumn('from_warehouse', function ($row) {
            return $row->from_warehouse_id ? $row->fromWarehouse->name : '-';
        })
        ->addColumn('to_warehouse', function ($row) {
            return $row->to_warehouse_id ? $row->toWarehouse->name : '-';
        })

        ->rawColumns(['action'])
        ->make(true);
    }

    public function show($id){
        $stocktransfer = StockTransfer::With('product','fromWarehouse','toWarehouse')->findOrFail($id);

        $data = [
            'ID'=>$stocktransfer->id,
            'Quantity'=>$stocktransfer->quantity,
            'Product'=>"{$stocktransfer->product->name}",
            'From Warehouse'=>$stocktransfer->fromWarehouse->name,
            'To Warehouse'=>$stocktransfer->toWarehouse->name,
            'Transfer Date'=>$stocktransfer->transfer_date,

        ];
        return view('lookups.show',['datas'=>$data]);
    }
}
