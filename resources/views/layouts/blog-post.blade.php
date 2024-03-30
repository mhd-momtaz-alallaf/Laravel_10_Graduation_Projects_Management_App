<x-home-master>
    @section('content')
        @if(Session::has('select-massage'))
            <div class="alert alert-success">{{Session::get('select-massage')}}</div>
        @endif
        <!-- Title -->
        <h1 class="mt-4">{{$project->title}}</h1>

        <!-- Author -->
        <p class="lead">
            By Dr.
            <a href="#">{{$project->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Added: {{$project->created_at->diffForHumans()}} </p>

        <hr>

        <!-- Project Content -->
        <p class="lead">{{$project->description}}</p>
        @if(auth()->check())
        <form method="post" action="{{route('project.select',$project)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            @method('PUT')
            <input type="hidden" name="userid" value="{{auth()->user()->id}}">
            <button type="submit" class="btn btn-primary"

                    @if($project->status!= "available" || auth()->user()->status == 1 )
                        disabled
                    @endif

            >Select Project
            </button>
            @if($project->status != "available")
                <div class="alert alert-danger"><h6>This Project Was Selected By ({{$project['student']}})</h6></div>
            @endif

            @if(auth()->user()->status == 1)
                <div class="alert alert-danger"><h6>You Have Already Select a Project!</h6></div>
            @endif

        </form>
        @endif
            <hr>
    @endsection

</x-home-master>
