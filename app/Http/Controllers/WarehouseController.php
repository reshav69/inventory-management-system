<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    public function index(){
        $this->authorize('viewAny', Warehouse::class);

        return view('lookups.index', [
            'title' => 'View Warehouses',
            'dataUrl'   => route('warehouses.data'),
            'type'   => 'warehouses',
            'columns'=>['Name','Status','Location'],
            'columnsConfig'   => [
                ['data' => 'name', 'name' => 'name'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'location', 'name' => 'location'],
            ],

        ]);
    }

    public function data(){
        $this->authorize('viewAny', Warehouse::class);
        return DataTables::of(Warehouse::query())->addIndexColumn()
        ->addColumn('action', function($row){
            return view('lookups.action', ['type'=>'warehouses','model' => $row])->render();
        })
        ->editColumn('status', fn($row) => $row->status? '<span class="badge bg-success">Active</span>' :
           '<span class="badge bg-danger">Inactive</span>')
        ->rawColumns(['status','action'])
        ->make(true);
    }

    public function show(Warehouse $warehouse){
        $this->authorize('view', $warehouse);
        $products = $warehouse->products->map(function ($product) {
            return "{$product->name} ({$product->pivot->quantity})";
        })->implode(', ');
        
        // dd($products);
        $data = [
            'ID'=>$warehouse->id,
            'Name'=>$warehouse->name,
            'Status'=>$warehouse->status,
            'Location'=>$warehouse->location,
            'Products'=>$products
            
        ];

        return view('lookups.show', ['datas'=>$data]);

    }

    public function create(){
        $title = "Add a Warehouse";
        return view('admin.warehouses.create',['title'=>$title]);
    }
    public function store(StoreWarehouseRequest $request){
        try{
            $data = $request->validated();
            Warehouse::create($data);
            return back()->with('success','Added a warehouse');
        }catch(\Throwable $th){
            return back()->withErrors(['db_error'=>'Adding Failed']);
        }
    }
    public function edit(Warehouse $warehouse ){
        $this->authorize('update', $warehouse);
        return view('admin.warehouses.edit',compact('warehouse'));
    }

    
    public function update(UpdateWarehouseRequest $request ,Warehouse $warehouse){
        $this->authorize('update', $warehouse);
        try {
            $data = $request->validated();
            $warehouse->update($data);
            return back()->with('success','Edit Success');

        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors(['db_error'=>'Edit failed']);
        }
    }
    public function destroy(Warehouse $warehouse){
        $this->authorize('delete', $warehouse);
        try {
            // $hasStock = $warehouse->warehouseStocks()
            // ->where('quantity', '>', 0)
            // ->exists();

            // if ($hasStock) {
            //     return back()->withErrors([
            //         'db_error' => 'Warehouse has active stock, cannot delete'
            //     ]);
            // }
           $warehouse->delete();
           return back()->with('success','Delete Success');

       } catch (\Throwable $th) {
            //throw $th;
            // dd($th);
        return back()->withErrors(['db_error'=>'Deletion failed']);
    }
}

public function trashData(){
    return DataTables::of(
        Warehouse::withSum('warehouseStocks as quantity', 'quantity')->onlyTrashed()->orderBy('id','desc')
    )
    ->addIndexColumn()

    ->addColumn('quantity', fn($Warehouse) => $Warehouse->quantity ?? 0)
    ->addColumn('action', fn($row) => view('lookups.trash-action', ['type'=>'warehouses','model' => $row])->render())
    ->editColumn('status', fn($row) => $row->status
        ? '<span class="badge bg-success">Active</span>'
        : '<span class="badge bg-danger">Inactive</span>')
    ->rawColumns(['status','action'])
    ->make(true);
}

public function trash(){
    return view('lookups.trash-page', [
        'title' => 'View Warehouse Trash',
        'dataUrl'   => route('warehouses.trashData'),
        'type'   => 'warehouses',
        'columns'=>['Name','Status','Location','Deleted At'],
        'columnsConfig'   => [
            ['data' => 'name', 'name' => 'name'],
            ['data' => 'status', 'name' => 'status'],
            ['data' => 'location', 'name' => 'location'],
            ['data' => 'deleted_at', 'name' => 'deleted_at'],
        ],
    ]);

}
public function restore($id){
    $Warehouse = Warehouse::onlyTrashed()->findOrFail($id);
    $this->authorize('restore', $Warehouse);
    try {
                    //code...
        $Warehouse->restore();
        return back()->with('success', 'Warehouse restored successfully.');
    } catch (\Throwable $th) {
                    //throw $th;
        return back()->withErrors(['db_error'=>'Failed to restore']);
    }   

}
public function forceDelete($id){
 try {
     $Warehouse = Warehouse::onlyTrashed()->findOrFail($id);
     $this->authorize('forceDelete',$Warehouse); 
     $Warehouse->forceDelete();
     return back()->with('success','Warehouse deleted force fully');
 } catch (\Throwable $e) {
     return back()->withErrors(['db_error'=>'Failed to force delete']);
 }

}

}
