<div>
    <div class="container justify-content-center">
        <h1>Super User</h1>
        <h4>Role: {{ $role->name }}</h4>
        <div class="w-25 list-group">
            <label class="list-group-item">
                <input @if ($permissions->contains('add')) checked @endif wire:click="togglePermission('add')" class="form-check-input me-1" type="checkbox"
                    value="">
                Create Permission
            </label>
            <label class="list-group-item">
                <input @if ($permissions->contains('show')) checked @endif wire:click="togglePermission('show')" class="form-check-input me-1" type="checkbox"
                    value="">
                Read Permission
            </label>
            <label class="list-group-item">
                <input @if ($permissions->contains('update')) checked @endif wire:click="togglePermission('update')" class="form-check-input me-1" type="checkbox"
                    value="">
                Update Permission
            </label>
            <label class="list-group-item">
                <input @if ($permissions->contains('delete')) checked @endif wire:click="togglePermission('delete')" class="form-check-input me-1" type="checkbox"
                    value="">
                Delete Permission
            </label>
        </div>
    </div>
</div>
</div>
