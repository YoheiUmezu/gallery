    @extends('layouts.app')

    @section('content')
    
    <!------end add image---->
    @include('fraction')
        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    <div class="container">
    <h1>{{$albums->name}}({{$albums->images->count()}})</h1>
    <div class="container-fluid">
    
    <div class="row">
        @foreach($albums->images as $album)
        

      
        <div class="col-sm-3">
            <div class="item">
            <img src="{{asset('storage/'.$album->name)}}" class="img-thubnail" style="width:300px;" alt="">
            </div>

            <!-- Button trigger modal 
                引用元　https://getbootstrap.com/docs/4.3/components/modal/-->
            @if(Auth::check()&&Auth::user()->user_type=='admin')
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
                Delete
            </button>
            @endif
        </div>
       
            <!-- Modal -->
        <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Do you want to delete it ?{{$album->id}}
                </div>
                <div class="modal-footer">
                    <form action="{{route('image.delete')}}" method="POST">@csrf
                        <input type="hidden" name="id" value="{{$album->id}}">
                        <button class="btn btn-danger" type="submit">Delete</button>    
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                
                </div>
            </div>
            </div>
        </div>
            <!-- Modal Ends-->
        </div>
   
    </div>
        
    

</div>
@endforeach


@endsection
