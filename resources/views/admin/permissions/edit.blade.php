<x-admin-master>
    @section('content')
        @if(Session::has('permission-update-massage2'))
            <div class="alert alert-danger">{{Session::get('permission-update-massage2')}}</div>
        @endif
        <h1>Edit Permission: {{$permission->name}}</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permission.update',$permission)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">New Permission Name</label>
                        <input type="text"
                               name="name"
                               class="form-control
                                   @error('name')
                                       is-invalid
                                   @enderror"
                               id="name"
                               value="{{$permission->name}}"
                        >
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
