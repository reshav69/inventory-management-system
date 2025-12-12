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
            'columns'   => [
                ['name' => 'id', 'label' => 'ID'],
                ['name' => 'product', 'label' => 'Product'],
                ['name' => 'From Warehouse', 'label' => 'From Warehouse'],
                ['name' => 'To Warehouse', 'label' => 'To Warehouse'],
                ['name' => 'quantity', 'label' => 'Quantity'],
                ['name' => 'transfer_date', 'label' => 'Date'],


            ],
        ]);
    }
    public function create(){

    }

    public function data(){
        return DataTables::of(StockTransfer::query())
        ->addColumn('action', function($row){
            return view('lookups.action', ['type'=>'stocktransfers','model' => $row])->render();
        })
        ->addColumn('product', function ($row) {
            return $row->product_id ? $row->product->name : '-';
        })
        ->addColumn('From Warehouse', function ($row) {
            return $row->from_warehouse_id ? $row->fromWarehouse->name : '-';
        })
        ->addColumn('To Warehouse', function ($row) {
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
            'Product'=>
            "<button class=\"open-modal\" data-title='Product' data-url=\"products/{$stocktransfer->product->id}\">{$stocktransfer->product->name} </button>",
            'From Warehouse'=>$stocktransfer->fromWarehouse->name,
            'To Warehouse'=>$stocktransfer->toWarehouse->name,
            'Transfer Date'=>$stocktransfer->transfer_date,

        ];
        return view('lookups.show',['datas'=>$data]);
    }
}
