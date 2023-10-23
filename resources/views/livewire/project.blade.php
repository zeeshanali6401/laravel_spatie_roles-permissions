<div>
    <div class="container">
        <!-- Modal trigger button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateUserModal">
            Create User
        </button>
        <!-- Button trigger modal -->
        @can('add')
            {{-- Assuming 'add' is the ability and 'admin' is the resource --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">
                Add
            </button>
        @else
            <button class="btn btn-danger p-0" disabled>Sorry you haven't permission</button>
        @endcan

        <div class="table-responsive mt-3">
            @can('show')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($collection as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="text-left">
                                    @can('update')
                                        <button class="btn btn-primary btn-sm"
                                            wire:click="edit({{ $item->id }})">Edit</button>
                                    @endcan
                                    @can('delete')
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="delete({{ $item->id }})">Delete</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <strong>
                    <h3 class="text-left text-danger">You dont have any permission!</h3>
                </strong>
            @endcan
        </div>
        <!--Create Uer Modal Body -->
        <div wire:ignore.self class="modal fade" id="CreateUserModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="CreateUserModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CreateUserModal">Create New User</h5>
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
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-left">Select Role</label>
                                <div class="col-md-6">
                                    <select class="form-select" wire:model="role">
                                        <option value="#" selected @readonly(true)>Select</option>
                                        @foreach ($roleCollection as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            <h2>{{ $item->name }}</h2>
                                        @endforeach
                                    </select>
                                    @if (!is_null($permissions))

                                        @foreach ($permissions as $permission)
                                            <div class="list-group">
                                                <label class="list-group-item">
                                                    <input class="form-check-input me-1" wire:model="perms.{{ $permission->id }}" type="checkbox"
                                                        value="{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
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
        <!--Create Project Modal -->
        <div wire:ignore.self class="modal fade" class="modal fade" id="projectModal" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="projectModalLabel">Add Project</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="mb-3">
                                <label for="" class="form-label">Enter Title:</label>
                                <input type="text" class="form-control" wire:model="title"
                                    placeholder="Project Title">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Enter Description:</label>
                                <input type="text" class="form-control" wire:model="description"
                                    placeholder="Project Description">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
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
        $("#CreateUserModal").modal("hide");
        $("#projectModal").modal("hide");
    })
</script>
