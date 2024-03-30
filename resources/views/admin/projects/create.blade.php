<x-admin-master>
    @section('content')

        <h1>Add a New Project</h1>

        <form method="post" action="{{route('project.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       id="title"
                       aria-describedby=""
                       placeholder="Enter Project Title">
            </div>
            <div class="form-group">
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
                             rows="10"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>



    @endsection
</x-admin-master>
