<x-admin-master>
    @section('content')
        @if(Session::has('permission-delete-massage'))
            <div class="alert alert-danger">{{Session::get('permission-delete-massage')}}</div>
        @elseif(session('permission-create-massage'))
            <div class="alert alert-success">{{Session('permission-create-massage')}}</div>
        @elseif(session('permission-update-massage'))
            <div class="alert alert-success">{{Session('permission-update-massage')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permissions.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Permission Name</label>
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
                @if($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Permission</h6>
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
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{$permission->id}}</td>
                                            <td><a href="{{route('permission.edit',$permission)}}" >{{$permission->name}}</a></td>
                                            <td>{{$permission->slug}}</td>
                                            <td>{{$permission->created_at->diffForhumans()}}</td>
                                            <td>{{$permission->updated_at->diffForhumans()}}</td>
                                            <td>
                                                <form method="post" action="{{route('permission.destroy',$permission)}}" enctype="multipart/form-data">
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
                    <div class="alert alert-danger">There is No Permissions Yet</div>
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
