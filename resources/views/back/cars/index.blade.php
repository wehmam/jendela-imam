@extends("back.layouts")
@section('title', 'Cars')
@section("external-css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">List Cars <span><a class="btn btn-sm btn-success" href="{{ url("management/cars/create") }}">Add Cars</a></span> </h4>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="table-cars">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("external-js")
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        var dataTable = $('#table-cars').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            bFilter:false,
            info: true,
            ordering: false,
            deferRender: true,
            ajax: {
                'url' : `list-cars`,
            },
            responsive: {
                details : {
                    type: 'column'
                }
            },
            columnDefs: [{
                className: 'text-center',
                orderable: false,
                targets: [0 , 1, 2, 3]
            }],
            drawCallback: function( settings ) {
                $('html, body').animate({
                    scrollTop: 0,
                }, 'slow');

                $('[name=page]').val(settings.json.page);
            }
        })
    })

    function deleteCars(id) {
        $.ajax({
            url: `${window.location.origin}/management/cars/${id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire(
                    response.status == false ? "Opps!" : "Success!" ,
                    response.message,
                    response.status == false ? "error" : "success"
                )

                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr) {
                Swal.fire (
                    "Opps!",
                    xhr.responseText,
                    error
                )
            }
        });
    }
</script>
@endsection
