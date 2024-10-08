<div class="container mt-3">
    <h1>Permissions for Role: {{ $permission_role->name }}</h1>
    <table class="table table-striped table-bordered" id="modaltb">
        <thead>
            <tr>
                <th>#</th>
                <th>Permission Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($permissionData->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">No permissions assigned to this role.</td>
                </tr>
            @else
                @foreach ($permissionData as $index => $permission)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $permission['permission_name'] }}</td>
                        <td>

                            <button class="btn btn-danger btn-sm" 
                                onclick="removePermission({{ $permission['permission_role_id'] }})"
                                title="Remove permission">
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
