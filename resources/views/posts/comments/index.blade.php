@extends('layouts');

@section('title', 'All Comments')
@endsection
@section('content')

{{-- <a href={{route("comments.create")}} class="btn btn-primary"> Add Comment </a> --}}

<div class="row">
    @foreach ($comments as $comment)
    <div class="col-md-4 mb-4">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">{{$comment->message_prompt}}</h5>               
                {{-- <a class="btn btn-primary" href={{route("categories.show", $category)}}> Show </a>

                <a class="btn btn-warning" href={{route("categories.edit", $category->id)}}> Edit </a> --}}


                {{-- <a class="btn btn-primary" href={{route("courses.show", $course->id)}}> Show </a>
                <a class="btn btn-warning" href={{route("courses.edit", $course->id)}}> Edit </a>
                <a class="btn btn-danger" href=> Delete </a> --}}

                {{-- <form action={{route("categories.destroy", $category->id)}} method='post'>
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger" type="submit"> Delete </button>
                </form> --}}
            </div>
        </div>
    </div>
@endforeach
</div>