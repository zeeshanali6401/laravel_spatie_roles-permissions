@extends('layouts.app')
@section('content')
<div class="container w-25">
  <form method="post" action="{{route('role.store')}}">
    @csrf
      <div class="form-group">
        <label>Role Name</label>
        <input type="text" class="form-control" name="name" placeholder="Role Name" autofocus>
      </div>
      <div class="form-group">
        <div class="form-group">
          <label>Permission Select</label>
          <select multiple class="form-control" name="permission[]">
            @foreach ($permissions as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
        </div>
      </div>
      <div class="form-group">
        <label>guard_name</label>
        <input value="web" readonly type="text" class="form-control" name="guard_name" placeholder="guard_name">
      </div><br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
