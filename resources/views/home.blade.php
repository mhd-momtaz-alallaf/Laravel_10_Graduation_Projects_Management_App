<x-home-master>

@section('content')
        <h1 class="my-4">All Projects</h1>

        <!-- Blog Project -->

        @foreach($projects as $project)

            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{$project->title}} <h6>({{$project->status}})</h6></h2>
                    <h3 class="card-title">Dr.{{$project->user->name}}</h3>
                    <p class="card-text">{{Str::limit($project->description,'100','....')}}</p>
                    <a href="{{route('project',$project->id)}}" class="btn btn-primary">View Project &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    {{$project->created_at->diffForHumans()}}
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>

@endsection

</x-home-master>
