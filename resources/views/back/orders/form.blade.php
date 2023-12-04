@extends("back.layouts")
@section('title', 'Orders')
@section("external-css")
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 38px !important;
        /* padding: 10px 16px; */
        padding: 5px;
        /* font-size: 18px;  */
        line-height: 1.33;
        border-radius: 6px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top: 75% !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #CCC !important;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    }

    .delete-price-type-range-field {
        color: red;
    }
    .delete-price-type-range-field:hover {
        color: red;
        cursor: pointer;
    }

</style>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Orders</h4>
    <div class="row">
        <!-- Inline text elements -->
        <div class="col">
            <div class="card mb-4">
                <h5 class="card-header mb-5">Make Orders</h5>
                <div class="card-body">
                    <form action="{{ Request::segment(3) == "create" ? url("management/orders") : url("management/orders/" . $order->id) }}" method="POST" >
                        @csrf
                        @if(Request::segment(3) != "create")
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Customer Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control @error("customer_name") is-invalid @enderror" id="basic-default-name" name="customer_name" value="{{ $order->name ?? old("customer_name") }}" placeholder="Imam Maulana Ashari" />
                            @error('customer_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control @error("phone") is-invalid @enderror" id="basic-default-phone" name="phone" value="{{ $order->phone ?? old("phone") }}" placeholder="085883818326" />
                              @error('phone')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                          <div class="col-sm-10">
                            <input
                              type="text"
                              name="email"
                              class="form-control @error("email") is-invalid @enderror"
                              id="basic-default-email"
                              placeholder="readytosurff@gmail.com"
                              value="{{ $order->email ?? old("email") }}"
                            />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-cars">Cars</label>
                            <div class="col-sm-10">
                                <select name="cars" class="form-control" id="basic-default-cars">
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}">{{ $car->name . ' - ' . ("Rp. " . nominalFormat($car->price)) }}</option>
                                    @endforeach
                                </select>

                                @error('cars')
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-default-cars').select2();
    });
</script>
@endsection
