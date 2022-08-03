@include('layouts.start')
<hr>
<!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Order</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" action="{{route('order.create')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Title:</label>
              <input type="text"  name="title" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Image:</label>
                <input type="file" name="image" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Expired On:</label>
                <input type="date" name="expired" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Price:</label>
                <input type="number" name="price" class="form-control" id="recipient-name">
            </div>
            <button type="submit" class="btn btn-primary">Submit Order</button>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
</div>
<hr>
<div class="row m-5">
  @foreach ($orders as $item)
  <div class="card m-5" style="width: 18rem;">
      <img class="card-img-top" src="{{asset('order').'/'.$item->image}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$item->title}}</h5>
      <p class="card-text">Price: {{$item->price}}</p>
      <p class="card-text">Status: {{$item->status}}</p>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}">
        Edit
      </button>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form enctype="multipart/form-data" action="{{route('order.update')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Status:</label>
                  <select  class="form-control" id="recipient-name" name="status">
                    <option value="{{$item->status}}">{{$item->status}}</option>
                    <option value="New Order">New Order</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Waiting For Buyer">Waiting For Buyer</option>
                    <option value="Completed">Completed</option>

                  </select>
                </div>
                <input type="hidden" value="{{$item->id}}" name="id">
                <button type="submit" class="btn btn-primary">Update Order</button>
    
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <a href="{{route('order.delete.admin',$item->id)}}" class="btn btn-danger">Delete</a>
      </div>
    </div>
      
  
  @endforeach

</div>
@include('layouts.end')