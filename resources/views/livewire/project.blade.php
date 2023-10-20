<div>
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">
            Add
        </button>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm" wire:click="edit({{ $item->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $item->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
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
    window.addEventListener('hideModal', event => { // Add User Modal display
        $("#projectModal").modal("hide");
    })
</script>