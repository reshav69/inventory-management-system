<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        // $products = Product::all();
        return view('lookups.index', [
            'title' => 'View Users',
            'dataUrl'   => route('users.data'),
            'type'   => 'users',
            'columns'=>['First Name','Last Name','Email','Status','Role'],
            'columnsConfig'   => [
                ['data' => 'first_name', 'name' => 'first_name'],
                ['data' => 'last_name', 'name' => 'last_name'],
                ['data' => 'email', 'name' => 'email'],
                ['data' => 'status', 'name' => 'status'],
                ['data' => 'role', 'name' => 'role'],
            ],
        ]);
    }

    public function data(){
        // $this->authorize('viewAny', User::class);
        return DataTables::of(User::query())->addIndexColumn()
        ->addColumn('action', function($row){
            return view('lookups.action', ['type'=>'users','model' => $row])->render();
        })
        ->editColumn('status', fn($row) => $row->status? '<span class="badge bg-success">Active</span>' :
             '<span class="badge bg-danger">Inactive</span>')
        ->rawColumns(['status','action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',User::class);

        $roles = ['Staff','Admin'];
        return view('admin.users.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create',User::class);
        try{
            $data = $request->validated();
            // dd($data);
            // $data['password'] = Hash::make($data['password']);
            User::create($data);
            return back()->with('success','Added a new user');
        }catch(\Throwable $th){
            // dd($th->getMessage());
            return back()->withErrors(['db_error'=>'Adding Failed']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);

        $data = [
            'User ID'=>$user->id,
            'First Name'=>$user->first_name,
            'Last Name'=>$user->last_name,
            'Email'=>$user->email,
            'User role'=>$user->role,
            'User status'=>$user->status ? '<span class="badge bg-success">Active</span>' :
             '<span class="badge bg-danger">Inactive</span>',
        ];
        return view('lookups.show',['datas'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

        return view('admin.users.edit',compact('user'),['title'=>'Edit user']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update',$user);
        $data = $request->validated();
        try{
            if (blank($data['password'])) {
                unset($data['password']);
            }
        
            $user->update($data);
            return back()->with('success','User Updated');
        }catch(\Throwable $th){
            dd($th->getMessage());
            return back()->withErrors(['db_error'=>'Updating User Failed']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
