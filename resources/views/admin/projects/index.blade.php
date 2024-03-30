<x-admin-master>
    @section('content')
        <h1>All Projects</h1>
    @if(count($projects)>0)
        @if(Session::has('delete-massage'))
            <div class="alert alert-danger">{{Session::get('delete-massage')}}</div>
        @elseif(session('create-massage'))
            <div class="alert alert-success">{{Session('create-massage')}}</div>
        @elseif(session('update-massage'))
            <div class="alert alert-success">{{Session('update-massage')}}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Doctor</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>student</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Doctor</th>
                            <th>Title</th>
                            <th>description</th>
                            <th>student</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{$project->id}}</td>
                                    <td>{{$project->user->name}}</td>
                                    <td><a href="{{route('project.edit',['project'=>$project->id])}}">{{$project->title}}</a></td>
                                    <td>{{$project->description}}</td>
                                    <td>{{$project->student}}</td>

                                    <td>
                                        <img width="100px" src="{{$project->project_image}}" alt="">
                                    </td>
                                    <td>{{$project->created_at->diffForhumans()}}</td>
                                    <td>{{$project->updated_at->diffForhumans()}}</td>
                                    <td>
                                        @can('view',$project)
                                        <form method="post" action="{{route('project.destroy',$project->id)}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @endcan

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
{{--        <div class="d-flex">--}}
{{--            <div class="mx-auto">--}}
{{--            <!-- Display pagination links -->--}}
{{--            {{$projects->links()}}--}}
{{--            </div>--}}
{{--        </div>--}}
    @else
        <div class="alert alert-danger">There is No Projects Yet</div>
    @endif
    @endsection

    @section('scripts')
            <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTable.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>
