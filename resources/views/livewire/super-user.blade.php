<div>
    {{-- @dd($permissions) --}}
    <div class="container justify-content-center">
        <h1>Super User</h1>
        @foreach ($roleCollection as $item)
        <!-- Modal trigger button -->
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">
          Update {{ $item->name }} Role
        </button>

        <!-- Modal Body -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Role Update</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            <label class="list-group-item">
                              <input class="form-check-input me-1" type="checkbox" value="">
                              Create
                            </label>
                            <label class="list-group-item">
                              <input class="form-check-input me-1" type="checkbox" value="">
                              Read
                            </label>
                            <label class="list-group-item">
                              <input class="form-check-input me-1" type="checkbox" value="">
                              Update
                            </label>
                            <label class="list-group-item">
                              <input class="form-check-input me-1" type="checkbox" value="">
                              Delete
                            </label>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Optional: Place to the bottom of scripts -->
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

        </script>

        @endforeach


    </div>
</div>
