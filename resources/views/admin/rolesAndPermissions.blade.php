@extends('adminlte::page')

@section('title', 'Ruoli e permessi')

@section('personalizedScripts')
    <script type="text/javascript">

        function resetAllInputInNode(idNode) {
            var node = $("#"+idNode);
            node.find('input, select, textarea').val('').removeAttr('checked').removeAttr('selected');
        }

        function showModal(idModal, idParam1 = null, valueParam1 = null, idParam2 = null, valueParam2 = null)
        {
            resetAllInputInNode(idModal);
            $('#'+idModal).modal('show');
            if(typeof idParam1 != "undefined" && typeof valueParam1 != "undefined")
            {
                $('#'+idParam1).val(valueParam1).html(valueParam1);
            }
            if(typeof idParam2 != "undefined" && typeof valueParam2 != "undefined")
            {
                $('#'+idParam2).val(valueParam2).html(valueParam2);
            }
        }

        function showError(errorMsg)
        {
            $('.actionModal').modal('hide');
            $('#errorModalMsg').html(errorMsg);
            $('#errorModal').modal('show');
        }

        function createPermission(_permissionName = "") {
            var permissionName = (_permissionName != "") ? _permissionName : $("#createPermissionModalPermissionName").val();
            $.ajax({
                type:'POST',
                url:'/admin/createPermission',
                data:{
                    permissionName:permissionName,
                },
                success:function(data) {
                    location.reload();
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function deletePermission() {
            var idPermission = $("#deletePermissionModalIdPermission").val();
            $.ajax({
                type:'POST',
                url:'/admin/deletePermission',
                data:{
                    idPermission:idPermission,
                },
                success:function(data) {
                    location.reload();
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function createRole(_roleName = "") {
            var roleName = (_roleName != "") ? _roleName : $("#createRoleModalRoleName").val();
            $.ajax({
                type:'POST',
                url:'/admin/createRole',
                data:{
                    roleName:roleName,
                },
                success:function(data) {
                    location.reload();
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function deleteRole() {
            var idRole = $("#deleteRoleModalIdRole").val();
            $.ajax({
                type:'POST',
                url:'/admin/deleteRole',
                data:{
                    idRole:idRole,
                },
                success:function(data) {
                    location.reload();
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function givePermissionToRole(idRole) {
            var idPermission = $("#editRoleModalSelectPermission").val();
            $.ajax({
                type:'POST',
                url:'/admin/givePermissionToRole',
                data:{
                    idRole:idRole,
                    idPermission: idPermission,
                },
                success:function(data) {
                    $('#editRoleModal').modal('hide');
                    getRolePermissions(idRole, data.role.name);
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function revokePermissionToRole(idRole, idPermission) {
            $.ajax({
                type:'POST',
                url:'/admin/revokePermissionToRole',
                data:{
                    idRole:idRole,
                    idPermission: idPermission,
                },
                success:function(data) {
                    $('#editRoleModal').modal('hide');
                    getRolePermissions(idRole);
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function assignRoleToUser(idUser) {
            var idRole = $("#editUserModalSelectRole").val();
            $.ajax({
                type:'POST',
                url:'/admin/assignRoleToUser',
                data:{
                    idRole:idRole,
                    idUser: idUser,
                },
                success:function(data) {
                    $('#editUserModal').modal('hide');
                    getUserRoles(idUser, data.user.name);
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function removeRoleToUser(idUser, idRole) {
            $.ajax({
                type:'POST',
                url:'/admin/removeRoleToUser',
                data:{
                    idRole:idRole,
                    idUser: idUser,
                },
                success:function(data) {
                    $('#editUserModal').modal('hide');
                    getUserRoles(idUser);
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function getRolePermissions(idRole, roleName) {
            $.ajax({
                type:'POST',
                url:'/admin/getRolePermissions/'+idRole,
                success:function(data) {
                    var permissions = data.hasOwnProperty("permissions") ? data.permissions : false;
                    if(!permissions)
                    {
                        var errorMsg = "<?= __('admin.genericError') ?>";
                        showError(errorMsg);
                        return false;
                    }

                    $("#editRoleModalRolename").html(roleName);
                    $(".editRoleModalTr:not(#editRoleModalExampleTr)").remove();
                    permissions.forEach(function(permission, index) {
                        var $permissionElem = $( "#editRoleModalExampleTr" ).clone();
                        $permissionElem[0].id = "editRoleModalTr" + permission.id;
                        $permissionElem.find(".editRoleModalName").html(permission.name);
                        $permissionElem.find(".editRoleModalDelete").unbind("click").click(function(){ revokePermissionToRole(idRole, permission.id); });
                        $permissionElem.removeClass("d-none");
                        $("#editRoleModalTable").append($permissionElem);
                    });

                    $("#editRoleModalAddPermission").unbind("click").click(function(){ givePermissionToRole(idRole); });
                    showModal("editRoleModal");
                    $("#editRoleModalSelectPermission").val(0);
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }

        function getUserRoles(idUser, userName) {
            $.ajax({
                type:'POST',
                url:'/admin/getUserRoles/'+idUser,
                success:function(data) {
                    var roles = data.hasOwnProperty("roles") ? data.roles : false;
                    if(!roles)
                    {
                        var errorMsg = "<?= __('admin.genericError') ?>";
                        showError(errorMsg);
                        return false;
                    }

                    $("#editUserModalUserName").html(userName);
                    $(".editUserModalTr:not(#editUserModalExampleTr)").remove();
                    roles.forEach(function(role, index) {
                        var $roleElem = $( "#editUserModalExampleTr" ).clone();
                        $roleElem[0].id = "editUserModalTr" + role.id;
                        $roleElem.find(".editUserModalName").html(role.name);
                        $roleElem.find(".editUserModalDelete").unbind("click").click(function(){ removeRoleToUser(idUser, role.id); });
                        $roleElem.removeClass("d-none");
                        $("#editUserModalTable").append($roleElem);
                    });

                    $("#editUserModalAddRole").unbind("click").click(function(){ assignRoleToUser(idUser); });
                    showModal("editUserModal");
                    $("#editUserModalSelectRole").val(0);
                },
                error:function (data) {
                    var errorMsg = data.hasOwnProperty("responseJSON") && data.responseJSON.hasOwnProperty("message") ? data.responseJSON.message : '<?= __('admin.genericError') ?>';
                    showError(errorMsg);
                }
            });
        }
    </script>
@stop

@section('content_header')
    <h1 class="m-0 text-dark"><?= __('admin.rolesAndPermissions') ?></h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

            <!-- ##### Roles ##################### -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><?= __('admin.roles') ?></h3>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-sm table-hover">
                        @role(\App\Libraries\Permissions::ROLE_SUPER_ADMIN)
                        @foreach ($rolesToBeCreated as $roleToBeCreated)
                            <tr class="bg-dark">
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            {{ $roleToBeCreated }} <span class="text-danger font-italic">(<?= __('admin.missing') ?>)</span>
                                        </div>
                                        <div class="col-12 col-md-2 text-right">
                                            <button type="button" class="btn btn-success"
                                                    onclick="createRole('{{$roleToBeCreated}}')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endrole

                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            {{ $role->name }}
                                        </div>
                                        <div class="col-12 col-md-2 text-right">
                                            @if($role->name != \App\Libraries\Permissions::ROLE_SUPER_ADMIN)
                                                @can(\App\Libraries\Permissions::PERM_WRITE_PERMISSIONS)
                                                    <button type="button" class="btn btn-primary" onClick="getRolePermissions({{ $role->id }}, '{{ $role->name }}');">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger"
                                                            onclick="showModal('deleteRoleModal', 'deleteRoleModalIdRole', {{ $role->id }}, 'deleteRoleModalRolename', '{{ $role->name }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                            @else
                                                <span class="font-italic"><?= __('admin.notEditable') ?></span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @can(\App\Libraries\Permissions::PERM_WRITE_PERMISSIONS)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-10"></div>
                                        <div class="col-12 col-md-2 text-right">
                                            <button type="button" class="btn btn-success" onclick="showModal('createRoleModal')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endcan

                    </table>

                </div>
            </div>

            <!-- ############### Permissions ################ -->
            @role(\App\Libraries\Permissions::ROLE_SUPER_ADMIN)
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><?= __('admin.permissions') ?></h3>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-sm table-hover">
                        @foreach ($permissionsToBeCreated as $permissionToBeCreated)
                            <tr class="bg-dark">
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            {{ $permissionToBeCreated }} <span class="text-danger font-italic">(<?= __('admin.missing') ?>)</span>
                                        </div>
                                        <div class="col-12 col-md-2 text-right">
                                            <button type="button" class="btn btn-success"
                                                    onclick="createPermission('{{$permissionToBeCreated}}')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            {{ $permission->name }}
                                        </div>
                                        <div class="col-12 col-md-2 text-right">
                                            @if(!\App\Libraries\Permissions::isPermissionManaged($permission->name))
                                                <button type="button" class="btn btn-danger"
                                                        onclick="showModal('deletePermissionModal', 'deletePermissionModalIdPermission', {{ $permission->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <span class="font-italic"><?= __('admin.notEditable') ?></span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-12 col-md-10"></div>
                                    <div class="col-12 col-md-2 text-right">
                                        <button type="button" class="btn btn-success" onclick="showModal('createPermissionModal')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>
            @endrole

            <!-- ##### Users ##################### -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><?= __('admin.users') ?></h3>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-sm table-hover">
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-12 col-md-10">
                                            {{ $user->name }}
                                        </div>
                                        <div class="col-12 col-md-2 text-right">
                                            @can(\App\Libraries\Permissions::PERM_WRITE_PERMISSIONS)
                                                <button type="button" class="btn btn-primary" onClick="getUserRoles({{ $user->id }}, '{{ $user->name }}');">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>

        </div>
    </div>
@stop

<!-- Modal error message -->
<div class="modal errorModal" tabindex="-1" role="dialog" id="errorModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.error') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="errorModalMsg"></span>
            </div>
        </div>
    </div>
</div>

<!-- Modal add role -->
<div class="modal actionModal" tabindex="-1" role="dialog" id="createRoleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.addRole') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-roleName"><?= __('admin.roleName') ?></span>
                    </div>
                    <input type="text" class="form-control" aria-label="Nome ruolo" aria-describedby="inputGroup-roleName" id="createRoleModalRoleName"
                           placeholder="Es.: Operatore">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ann<?= __('admin.close') ?>ulla</button>
                <button type="button" class="btn btn-success" onClick="createRole()"><?= __('admin.create') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit role -->
<div class="modal actionModal" tabindex="-1" role="dialog" id="editRoleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.editRole') ?> <span id="editRoleModalRolename"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editRoleModalIdRole">
                <table class="table table-striped table-sm table-hover" id="editRoleModalTable">
                    <tr class="editRoleModalTr d-none" id="editRoleModalExampleTr">
                        <td>
                            <div class="row">
                                <div class="col-12 col-md-10 editRoleModalName">
                                </div>
                                <div class="col-12 col-md-2 text-right">
                                    <button type="button" class="btn btn-danger editRoleModalDelete" onclick="">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-12 col-md-10">
                                    <select id="editRoleModalSelectPermission">
                                        <option value="0" selected><?= __('admin.select') ?>...</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 text-right">
                                    <button type="button" class="btn btn-success" id="editRoleModalAddPermission" onclick="">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('admin.close') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal delete role -->
<div class="modal actionModal" tabindex="-1" role="dialog" id="deleteRoleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.deleteRole') ?> <span id="deleteRoleModalRolename"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= __('admin.confirmationDeleteRole') ?>
                <input type="hidden" id="deleteRoleModalIdRole">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('admin.close') ?></button>
                <button type="button" class="btn btn-danger" onClick="deleteRole()"><?= __('admin.delete') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal add permission -->
<div class="modal actionModal" tabindex="-1" role="dialog" id="createPermissionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.addPermission') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-permissionName"><?= __('admin.permissionName') ?></span>
                    </div>
                    <input type="text" class="form-control" aria-label="Nome permesso" aria-describedby="inputGroup-permissionName" id="createPermissionModalPermissionName"
                           placeholder="Es.: read orders">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('admin.close') ?></button>
                <button type="button" class="btn btn-success" onClick="createPermission()"><?= __('admin.create') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal delete permission -->
<div class="modal actionModal" tabindex="-1" role="dialog" id="deletePermissionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.deletePermission') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= __('admin.confirmationDeletePermission') ?>
                <input type="hidden" id="deletePermissionModalIdPermission">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('admin.close') ?></button>
                <button type="button" class="btn btn-danger" onClick="deletePermission()"><?= __('admin.delete') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit user -->
<div class="modal actionModal" tabindex="-1" role="dialog" id="editUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('admin.editUser') ?> <span id="editUserModalUserName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editUserModalIdUser">
                <table class="table table-striped table-sm table-hover" id="editUserModalTable">
                    <tr class="editUserModalTr d-none" id="editUserModalExampleTr">
                        <td>
                            <div class="row">
                                <div class="col-12 col-md-10 editUserModalName">
                                </div>
                                <div class="col-12 col-md-2 text-right">
                                    <button type="button" class="btn btn-danger editUserModalDelete" onclick="">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-12 col-md-10">
                                    <select id="editUserModalSelectRole">
                                        <option value="0" selected><?= __('admin.select') ?>...</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-2 text-right">
                                    <button type="button" class="btn btn-success" id="editUserModalAddRole" onclick="">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __('admin.close') ?></button>
            </div>
        </div>
    </div>
</div>
