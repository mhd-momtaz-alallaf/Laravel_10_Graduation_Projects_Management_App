<x-admin-master>
    @section('content')
        <h1>{{$user->name}} Profile</h1>
        <div class="row">
            <div class="col-ms-6">
                <form method="post" action="{{route('user.profile.update',$user)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="m-4">
                        <div class="form-group">
                            <div class="mb-4">
                                <img class="img-profile rounded-circle" width="60" height="60"
                                     src="{{$user->avatar}}">
                            </div>
                            <label for="file">Profile Photo</label>
                            <input type="file" name="avatar">
                    </div>

                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input type="text"
                               name="username"
                               class="form-control
                               @error('username')
                                   is-invalid
                               @enderror"
                               id="username"
                               value="{{$user->username}}"
                        >
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control
                               @error('name')
                                   is-invalid
                               @enderror"
                               id="name"
                               value="{{$user->name}}"
                        >
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text"
                               name="email"
                               class="form-control
                               @error('email')
                                   is-invalid
                               @enderror"
                               id="email"
                               value="{{$user->email}}"
                        >
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control
                               @error('password')
                                   is-invalid
                               @enderror"
                               id="password"
                        >
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password"
                               name="password-confirmation"
                               class="form-control
                               @error('password-confirmation')
                                   is-invalid
                               @enderror"
                               id="password-confirmation"
                        >
                        @error('password-confirmation')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                @if(count($roles)>0)
                    @if(Session::has('user-delete-massage'))
                        <div class="alert alert-danger">{{Session::get('user-delete-massage')}}</div>
                    @elseif(session('create-massage'))
                        <div class="alert alert-success">{{Session('create-massage')}}</div>
                    @elseif(session('update-massage'))
                        <div class="alert alert-success">{{Session('update-massage')}}</div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                                        <th>Attach</th>
                                        <th>Detach</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td><input type="checkbox"
                                                    @foreach($user->roles as $user_role)
                                                        @if($user_role->slug == $role->slug)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                ></td>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->slug}}</td>
                                            <td>
                                                {{--                                        @can('view',$user)--}}
                                                <form method="post" action="{{route('user.role.attach',$user)}}" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="role" value="{{$role->id}}">
                                                    <button type="submit" class="btn btn-primary"

                                                    @if($user->roles->contains($role))
                                                        disabled
                                                    @endif

                                                    >Attach
                                                    </button>
                                                </form>
                                                {{--                                        @endcan--}}
                                            </td>
                                            <td>
                                                {{--                                        @can('view',$user)--}}
                                                <form method="post" action="{{route('user.role.detach',$user)}}" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @method('PUT')
                                                    <input type="hidden" name="role" value="{{$role->id}}">
                                                    <button type="submit" class="btn btn-danger"
                                                        @if(!$user->roles->contains($role))
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
