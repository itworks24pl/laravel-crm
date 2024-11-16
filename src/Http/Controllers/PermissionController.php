<?php

namespace VentureDrake\LaravelCrm\Http\Controllers;

use Spatie\Permission\Models\Permission;
use VentureDrake\LaravelCrm\Http\Requests\StoreRoleRequest;
use VentureDrake\LaravelCrm\Http\Requests\StorePermissionRequest;
use VentureDrake\LaravelCrm\Http\Requests\UpdateRoleRequest;
use VentureDrake\LaravelCrm\Http\Requests\UpdatePermissionRequest;
use VentureDrake\LaravelCrm\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $roles = Permission::crm()
            ->when(config('laravel-crm.teams'), function ($query) {
                return $query->where('team_id', auth()->user()->currentTeam->id);
            })
            ->get();
        */
        $permissions = Permission::all();
        return view('laravel-crm::permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-crm::permissions.create', [
            'permissions' => \VentureDrake\LaravelCrm\Models\Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = Permission::create([
            'name'=>$request->name,
            'description' => $request->description,
            'crm_permission' => $request->crm_permission ? 1 : 0,
        ]);

        flash(ucfirst(trans('laravel-crm::lang.permission_stored')))->success()->important();

        return redirect(route('laravel-crm.permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('laravel-crm::permissions.show', [
            'permission' => $permission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('laravel-crm::permissions.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
            'crm_permission' => $request->crm_permission ? 1 : 0,
        ]);
        flash(ucfirst(trans('laravel-crm::lang.permission_updated')))->success()->important();

        return redirect(route('laravel-crm.permissions.index', $permission));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (! in_array($role->name, ['Owner','Admin']) && $role->users->count() < 1) {
            foreach (Permission::all() as $permission) {
                $permission->removeRole($role);
            }

            $role->delete();

            flash(ucfirst(trans('laravel-crm::lang.role_deleted')))->success()->important();
        } else {
            flash(ucfirst(trans('laravel-crm::lang.role_cant_be_deleted')))->error()->important();
        }

        return redirect(route('laravel-crm.roles.index'));
    }
}
