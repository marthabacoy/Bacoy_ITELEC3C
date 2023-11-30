<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Brand
            </h2>
    </x-slot>

    <div class="py-12">
      <div class="container">
      <div class="row">

              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    Edit Categories
                  </div>  
                  <div class="card-body">
                   
                    <form action="{{url('brand/update/'.$brands->id)}}" method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="BrandName" class="form-label">Update Brand Name</label>
                        <input type="text" name ="brand_name"class="form-control" value="{{$brands->brand_name}}">
                        @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror

                        <input type="file" name="brand_image" class="form-control">
                                    @error('brand_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                      </div><br>
                      <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                  </div>
                </div>
              </div>
        </div>
    </div>
  </div>
</x-app-layout>
