<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Categories
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="container">
      <div class="row">
        <!-- Category List -->
        <div class="col-md-8">
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <div class="card">
          <div class="card-header">
              All Categories
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 1;
                  @endphp
                  @foreach ($categories as $category)
                  <tr>
                    <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->user->name}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>

                    <td>
                      <a href="{{url('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
                      <a href="{{url('category/remove/'.$category->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
              {{$categories->links()}}
            </div>
          </div>
        </div>

        <!-- Add Categories Form -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              Add Categories
            </div>
            <div class="card-body">
              <form action="{{route('add.category')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="CategoryName" class="form-label">Category Name</label>
                  <input type="text" name="category_name" class="form-control">
                  @error('category_name')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <button style="margin-top:20px" type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Deleted List -->
        <div class="col-md-12 mt-4">
          <div class="card">
            <div class="card-header">
              Deleted List
            </div>
            <div class="card-body">

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Deleted At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i = 1;
                  @endphp
                  @foreach ($trashCat as $trash)
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$trash->category_name}}</td>
                    <td>{{$trash->user->name}}</td>
                    <td>{{$trash->deleted_at->diffForHumans()}}</td>

                    <td>
                      <a href="{{url('category/restore/'.$trash->id)}}" class="btn btn-info">Restore</a>
                      <a href="{{url('category/delete/'.$trash->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
              {{$trashCat->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>