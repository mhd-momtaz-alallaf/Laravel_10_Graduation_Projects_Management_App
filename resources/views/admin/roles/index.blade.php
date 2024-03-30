<x-admin-master>
    @section('content')
        @if(Session::has('role-delete-massage'))
            <div class="alert alert-danger">{{Session::get('role-delete-massage')}}</div>
        @elseif(session('role-create-massage'))
            <div class="alert alert-success">{{Session('role-create-massage')}}</div>
        @elseif(session('role-update-massage'))
            <div class="alert alert-success">{{Session('role-update-massage')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('roles.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text"
                               name="name"
                               class="form-control
                                   @error('name')
                                       is-invalid
                                   @enderror"
                               id="name"
                        >
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </div>
                </form>

            </div>
            <div class="col-lg-9">
                @if(count($roles)>0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Roles</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td><a href="{{route('role.edit',$role)}}" >{{$role->name}}</a></td>
                                            <td>{{$role->slug}}</td>
                                            <td>{{$role->created_at->diffForhumans()}}</td>
                                            <td>{{$role->updated_at->diffForhumans()}}</td>
                                            <td>
                                                    <form method="post" action="{{route('role.destroy',$role)}}" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">There is No Roles Yet</div>
                @endif
            </div>

        </div>
    @endsection

        @section('scripts')
            <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
        @endsection
</x-admin-master>
