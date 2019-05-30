
    <!-------add image---->
    <!-- Button trigger modal -->
    @if(Auth::check()&&Auth::user()->user_type=='admin')
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        Add photos
      </button>
    @endif
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{$albums->name}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form id="form" action="{{route('album.image')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                                <label for="">Name of album</label>
                                <input type="hidden" name="id" value="{{$albums->id}}" class="form-control">
                            </div>
                            <div class="input-group control-group initial-add-more">
                                    <input type="file" name="image[]" class="form-control" id="image">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-add-more" type="button">Add</button>
                                </div>
                            </div>
                            <div class="copy" style="display:none;">
                                <div class="input-group control-group add-more" style="margin-top:12px;">
                                    <input type="file" name="image[]" class="form-control" id="image">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger remove" type="button">Remove</button>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" >Submit</button>
                            </div>
                    </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    
    
            </div>
            
          </div>
        </div>
      </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e){
            $(".btn-add-more").click(function(){
                //alert("ok");
                var html=$(".copy").html();
                $(".initial-add-more").after(html);
            });
            $("body").on("click",".remove",function(){
                $(this).parents(".control-group").remove();
            });
        });
    </script>
<style>
    

    .item{
        left: 8rem;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }

    .item img {
        -webkit-transition: 0.6s ease;
        transition: 0.6s ease;
        border: 1px solid red;
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