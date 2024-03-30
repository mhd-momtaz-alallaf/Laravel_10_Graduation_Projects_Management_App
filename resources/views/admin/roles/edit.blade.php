<x-admin-master>
    @section('content')
        @if(Session::has('role-update-massage2'))
            <div class="alert alert-danger">{{Session::get('role-update-massage2')}}</div>
        @endif
        <h1>Edit Role: {{$role->name}}</h1>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('role.update',$role)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">New Role Name</label>
                        <input type="text"
                               name="name"
                               class="form-control
                                   @error('name')
                                       is-invalid
                                   @enderror"
                               id="name"
                               value="{{$role->name}}"
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

        <div class="row">
            <div class="col-lg-12">
                @if($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Permissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Options</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Options</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td><input type="checkbox"
                                                       @foreach($role->permissions as $role_permission)
                                                           @if($role_permission->slug == $permission->slug)
                                                               checked
                                                    @endif
                                                    @endforeach
                                                ></td>
                                            <td>{{$permission->id}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->slug}}</td>
                                            <td>{{$permission->created_at->diffForhumans()}}</td>
                                            <td>{{$permission->updated_at->diffForhumans()}}</td>
                                            <td>
                                                {{--                                        @can('view',$user)--}}
                                                <form method="post" action="{{route('role.permissions.attach',$role)}}" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button type="submit" class="btn btn-primary"

                                                            @if($role->permissions->contains($permission))
                                                                disabled
                                                        @endif

                                                    >Attach
                                                    </button>
                                                </form>
                                                {{--                                        @endcan--}}
                                            </td>
                                            <td>
                                                {{--                                        @can('view',$user)--}}
                                                <form method="post" action="{{route('role.permissions.detach',$role)}}" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button type="submit" class="btn btn-danger"
                                                            @if(! $role->permissions->contains($permission))
                                                                disabled
                                                        @endif
                                                    >Detach
                                                    </button>
                                                </form>
                                                {{--                                        @endcan--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">There is No Permissions Yet</div>
                @endif
            </div>
        </div>
    @endsection
</x-admin-master>
