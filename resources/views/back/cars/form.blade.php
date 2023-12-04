@extends("back.layouts")
@section('title', 'Cars')
@section("external-css")
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cars</h4>
    <div class="row">
        <!-- Inline text elements -->
        <div class="col">
            <div class="card mb-4">
                <h5 class="card-header mb-5">Add Cars</h5>
                <div class="card-body">
                    <form action="{{ Request::segment(3) == "create" ? url("management/cars") : url("management/cars/" . $car->id) }}" method="POST" >
                        @csrf
                        @if(Request::segment(3) != "create")
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Cars Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error("name") is-invalid @enderror" id="basic-default-name" name="name" value="{{ $car->name ?? old("name") }}" placeholder="Brio RS" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-price">Price</label>
                          <div class="col-sm-10">
                            <input
                              type="number"
                              name="price"
                              class="form-control @error("price") is-invalid @enderror"
                              id="basic-default-price"
                              placeholder="1000000"
                              value="{{ $car->price ?? old("price") }}"
                            />
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-stock">Stock</label>
                            <div class="col-sm-10">
                              <input
                                type="number"
                                name="stock"
                                class="form-control @error("stock") is-invalid @enderror"
                                id="basic-default-stock"
                                placeholder="10"
                                value="{{ $car->stock ?? old("stock") }}"
                              />
                              @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("external-js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "#", // Replace with your upload route
        autoProcessQueue: false,
        maxFilesize: 2, // Max file size in MB
        acceptedFiles: ".jpg, .jpeg, .png, .gif", // Allowed file types
        addRemoveLinks: true,
    });

    myDropzone.on("addedfile", function (file) {
        // Handle file added event (e.g., display a thumbnail)
    });

    myDropzone.on("removedfile", function (file) {
        // Handle file removed event (if needed)
    });

    document.querySelector("#upload-button").addEventListener("click", function (e) {
        e.preventDefault();
        myDropzone.processQueue();
    });
</script>
@endsection
