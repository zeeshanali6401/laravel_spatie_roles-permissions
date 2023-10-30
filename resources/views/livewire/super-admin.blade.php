<div>
    <div class="container justify-content-center">
        <!-- Modal trigger button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionsModal">
          Add Permissions
        </button>



        <!-- Modal trigger button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
            Add Role
        </button>



        <!--Add Permissions Modal Body -->
        <div  wire:ignore.self  class="modal fade" id="addPermissionsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Add Permissions:</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="addPermissions">
                              <div class="form-group">
                                <label>Permission Name</label>
                                <input type="text" class="form-control" wire:model="permName" placeholder="Permission Name" autofocus>
                              </div>
                              <div class="form-group">
                                <label>guard_name</label>
                                <input value="web" readonly type="text" class="form-control" wire:model="permGuard" placeholder="guard_name">
                              </div><br>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Add Admin Modal trigger button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
          Add Admin
        </button>

        <!--Add Admin Modal Body -->
        <div wire:ignore.self class="modal fade" id="addAdminModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Add Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="createUser">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-left">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" wire:model="name"
                                        autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-left">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" wire:model="email"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-left">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" wire:model="password"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <select class="form-select form-select-lg" wire:model="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                                {{-- <button wire:click="userPermissions" class="btn btn-secondary">checker</button> --}}

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Optional: Place to the bottom of scripts -->
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('addAdminModal'), options)

        </script>

        <!--Add Role Modal Body -->
        <div wire:ignore.self class="modal fade" id="addRoleModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Add Role:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="addRole">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" wire:model="roleName" placeholder="Role Name"
                                    autofocus>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Permission Select</label>
                                    <select multiple class="form-control" wire:model="rolePermission">
                                        @if ($permissions)
                                            @foreach ($permissions as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>guard_name</label>
                                <input value="web" readonly type="text" class="form-control" name="guard_name"
                                    placeholder="guard_name">
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    window.addEventListener('hideModal', event => {
        $("#addPermissionsModal").modal("hide");
        $("#addRoleModal").modal("hide");
        $("#addAdminModal").modal("hide");
    })
    window.addEventListener('edit_modal', event => {
        $("#updateModal").modal("show");
    })
</script>
