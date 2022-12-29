<?php

namespace App\Http\Controllers\Admin\System\Management;

use \Exception;

use \Defender;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdministratorRequest;

use App\Models\System\Management\Administrator;

use App\Repositories\Contracts\AdministratorRepository;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AdministratorsController extends Controller
{
    /**
     * Constructor
     *
     * @param  AdministratorRepository  $administratorRepository  Administrator Repository Instance
     */
    public function __construct(AdministratorRepository $administratorRepository)
    {
        $this->administratorRepository = $administratorRepository;
    }

    /**
     * Show listing page.
     *
     * @return  Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = $this->administratorRepository->paginate(50);

        return view('front.templates.admin.system.management.administrators.index', compact('administrators'));
    }

    /**
     * Show creation page.
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        $permissionGroups = $this->getPermissionsGroups();

        return view('front.templates.admin.system.management.administrators.create', compact('permissionGroups'));
    }

    /**
     * Stores new record.
     *
     * @param  AdministratorRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function store(AdministratorRequest $request)
    {
        try {
            $attributes = [
                'name'     => $request->input('name'),
                'email'    => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ];

            $administrator = $this->administratorRepository->create($attributes);

            $this->processPermissions($administrator, $request->input('permissions', []));

            flash(trans('messages.success'), 'success');

            return response()->json([
                'success'       => true,
                'administrator' => $administrator,
                'redirect'      => route('admin.administrators.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.administrators.index'),
        ]);
    }

    /**
     * Show edit page.
     *
     * @param  Administrator  $administrator
     *
     * @return  Illuminate\Http\Response
     */
    public function edit(Administrator $administrator)
    {
        $permissionGroups = $this->getPermissionsGroups();

        return view('front.templates.admin.system.management.administrators.edit', compact('administrator', 'permissionGroups'));
    }

    /**
     * Updates record.
     *
     * @param  Administrator         $administrator
     * @param  AdministratorRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Administrator $administrator, AdministratorRequest $request)
    {
        try {
            if ($administrator->id == auth()->guard('administrator')->user()->id) {
                if ($request->input('name')) {
                    auth('administrator')->user()->name = $request->input('name');
                }

                if ($request->input('email')) {
                    auth('administrator')->user()->email = $request->input('email');
                }

                if ($request->input('password')) {
                    auth('administrator')->user()->password = bcrypt($request->input('password'));
                }

                auth('administrator')->user()->save();

            } else {
                $attributes = [
                    'name'  => $request->input('name'),
                    'email' => $request->input('email'),
                ];

                if ($request->input('password')) {
                    $attributes['password'] = bcrypt($request->input('password'));
                }

                $administrator = $this->administratorRepository->update($attributes, $administrator->id);
            }

            $this->processPermissions($administrator, $request->input('permissions', []));

            flash(trans('messages.success'), 'success');

            return response()->json([
                'success'       => true,
                'administrator' => $administrator,
                'redirect'      => route('admin.administrators.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.administrators.index'),
        ]);
    }

    /**
     * Destroy record.
     *
     * @param  Administrator  $administrator
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        try {
            if ($administrator->isSuperUser()) {
                flash(trans('messages.exception'), 'danger');

                return response()->json([
                    'success'  => false,
                    'redirect' => route('admin.administrators.index'),
                ]);
            }

            $this->administratorRepository->delete($administrator->id);

            flash(trans('messages.success'), 'success');

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.administrators.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.administrators.index'),
        ]);
    }

    /**
     * Process administrator permissions
     *
     * @param   Administrator  $administrator  Administrator instance
     * @param   array          $permissions    Permissions array
     * @return  void
     */
    private function processPermissions(Administrator $administrator, $permissions)
    {
        $administrator->revokePermissions();

        foreach ($permissions as $permissionId) {
            $permission = Defender::findPermissionById($permissionId);

            if ($permission) {
                $administrator->attachPermission($permission);
            }
        }
    }

    /**
     * Return permissions Groups List
     *
     * @return  Collection
     */
    private function getPermissionsGroups()
    {
        $groups = config('permissions.groups');

        foreach ($groups as $key => $group) {
            $permissions = collect($group['permissions']);

            $groups[$key]['permissions'] = $permissions->map(function($readableName, $permissionName) {
                $permission = Defender::findPermission($permissionName);

                if ($permission == false) {
                    $permission = Defender::createPermission($permissionName, $readableName);
                }

                $permission->readable_name = $readableName;

                return $permission;
            })->values();
        }

        return $groups;
    }
}
