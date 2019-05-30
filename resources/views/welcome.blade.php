@extends('layouts.app')

@section('content')
<div class="container">
        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    <h1>Albums</h1>
    @if(Auth::check()&&Auth::user()->user_type=='admin')
        <a href="album">Create Album</a>
    @endif
    <div class="row">
        @foreach($albums as $album)
        <div class="col-sm-4">
            <div class="item">
                <a href="albums/{{$album->id}}">
                    @if(empty($album->image))
                    <img src="images/vKipg8vLYtpunaX4bOlca6qxZ4x1DIkPL5zFaNkX.jpeg" alt="" class="img-thumbnail">
                    @else
                    <img src="{{asset('storage/'.$album->image)}}" class="img-thubnail" style="width:300px;" alt="">
                    @endif
                    <a href="albums/{{$album->id}}" class="centered">{{$album->name}}</a>
                </a>
            </div>

            <!-- Button trigger modal -->
            @if(Auth::check()&&Auth::user()->user_type=='admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
                Change Album Image
            </button>
            @endif
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('add.album.image')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="modal-body">
                <input type="file" name="image" class="form-control">
                <input type="hidden" name="id" value="{{$album->id}}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>
          </div>
        </div>
      </div>
        </div>
        @endforeach
        
    </div>
</div>



@endsection

<style>
    .item{
        left: 0;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }

    .item img {
        -webkit-transition: 0.6s ease;
        transition: 0.6s ease;
    }

    .item img:hover{
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
    }

    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: =translate(-50%,-50%);
        color: #fff;
        font-size:24px;
    }

    .img-thumbnail {
        border: 0px;
        border-radius: 0px;
    }
</style>