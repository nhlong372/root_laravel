@php
    $kind = !empty($kind) ? '.' . $kind : '';
@endphp

{!! $slot !!}
@if (Func::chekcPermission($tb . $kind . '.' . $type . '.edit', $permissions))
    <a class="text-primary mr-2" href="{{ url('admin', ['com' => $com, 'act' => 'edit', 'type' => $type], $params) }}"><i
            class="ti ti-edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
            title="Chỉnh sửa"></i></a>
@endif

@if (Func::chekcPermission($tb . $kind . '.' . $type . '.delete', $permissions))
    <a class="text-danger cursor-pointer" id="delete-item"
        data-url="{{ url('admin', ['com' => $com, 'act' => 'delete', 'type' => $type], $params) }}"><i
            class="ti ti-trash" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
            title="Xóa"></i></a>
@endif
