<x-admin-master>
    @section('content')
        <h1>All Users</h1>

        @if(count($users)>0)
            @if(Session::has('user-delete-massage'))
                <div class="alert alert-danger">{{Session::get('user-delete-massage')}}</div>
            @elseif(session('create-massage'))
                <div class="alert alert-success">{{Session('create-massage')}}</div>
            @elseif(session('update-massage'))
                <div class="alert alert-success">{{Session('update-massage')}}</div>
            @endif

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users DataTables</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Registered At</th>
                                <th>Profile Updated At</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Registered At</th>
                                <th>Profile Updated At</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        <img class="img-profile rounded-circle" width="60" height="60"
                                             src="{{$user->avatar}}">
                                    </td>
                                    <td><a href="{{route('user.profile.show',$user)}}">{{$user->username}}</a></td>
                                    <td>{{$user->name}} </td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                    <td>
{{--                                        @can('view',$user)--}}
                                            <form method="post" action="{{route('user.destroy',$user)}}" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
            <div class="alert alert-danger">There is No Users Yet</div>
        @endif
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
         <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>
