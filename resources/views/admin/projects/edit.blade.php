<x-admin-master>
    @section('content')

        <h1>Edit a Project</h1>

        <form method="post" action="{{route('project.update',$project->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <div>
                    <img height="100px" src="{{$project->project_image}}" alt="">
                </div>
                <label for="file">File</label>
                <input type="file"
                       name="project_image"
                       class="form-control-file"
                       id="project_image">
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       id="title"
                       aria-describedby=""
                       placeholder="Enter Project Title"
                       value="{{$project->title}}"
                >
            </div>
            <div class="form-group">
                <div>
                    <img height="100px" src="{{$project->project_image}}" alt="">
                </div>
                <label for="file">File</label>
                <input type="file"
                       name="project_image"
                       class="form-control-file"
                       id="project_image">
            </div>


            <div class="form-group">
                         <textarea
                             name="description"
                             class="form-control"
                             id="description"
                             cols="30"
                             rows="10">{{$project->description}}</textarea>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    @endsection
</x-admin-master>
