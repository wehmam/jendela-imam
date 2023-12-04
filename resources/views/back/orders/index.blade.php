@extends("back.layouts")
@section('title', 'Orders')
@section("external-css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">List Orders  <span><a class="btn btn-sm btn-success" href="{{ url("management/orders/create") }}">Add Orders</a></span></h4>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table" id="table-orders">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Cars Name</th>
                                <th>Price</th>
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
        var dataTable = $('#table-orders').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            bFilter:false,
            info: true,
            ordering: false,
            deferRender: true,
            ajax: {
                'url' : `list-orders`,
            },
            responsive: {
                details : {
                    type: 'column'
                }
            },
            columnDefs: [{
                className: 'text-center',
                orderable: false,
                targets: [0 , 1, 2, 3, 4]
            }],
            drawCallback: function( settings ) {
                $('html, body').animate({
                    scrollTop: 0,
                }, 'slow');

                $('[name=page]').val(settings.json.page);
            }
        })

    })
</script>
@endsection
