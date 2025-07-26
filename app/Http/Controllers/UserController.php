<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles', 'entreprises')->get();
        // dd($users);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $id = $user->id;
        return view('admin.user.edit', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }


    public function getDataTable() {
        $perPage = request()->input('length') ?? 30;
        $users = User::latest();
        $columns = Schema::getColumnListing('users');


        if(request()->input('search')) {
            $search = request()->input('search');
            $users = $users->where(function ($query) use ($search, $columns) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            })
            ->orWhereHas('roles', function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'asc');
        }

        // if (request()->input('order.0.column')) {
        //     $orderColumn = request()->input('order.0.column');
        //     $orderDirection = request()->input('order.0.dir');
        //     $users = $users->orderBy($columns[$orderColumn], $orderDirection);
        // }

        $users = $users->with('roles', 'entreprise');
        $users = $users->paginate($perPage);

        return response()->json(
            [
                'draw' => request()->get('draw'),
                'recordsTotal' => $users->total(),
                'recordsFiltered' => $users->total(),
                'data' => $users->items(),
            ], 200
        );
    }
}
