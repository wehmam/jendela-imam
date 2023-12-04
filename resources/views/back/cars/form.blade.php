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
                <h5 class="card-header">Inline Text Elements</h5>
                <div class="card-body">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                          <h5 class="mb-0 card-title">Media</h5>
                          <a href="javascript:void(0);" class="fw-medium">Add media from URL</a>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Product name, description, and other fields -->

                                <div class="form-group">
                                    <label for="images">Product Images</label>
                                    <div id="my-dropzone" class="dropzone"></div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </form>
                        </div>
                      </div>
                    {{-- <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="align-middle"><small class="text-light fw-semibold">Text Highlight</small>
                                </td>
                                <td class="py-3">
                                    <p class="mb-0">You can use the mark tag to <mark>highlight</mark> text.</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle"><small class="text-light fw-semibold">Deleted Text</small></td>
                                <td class="py-3">
                                    <p class="mb-0"><del>This line of text is meant to be treated as deleted text.</del>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">No Longer Correct</small></td>
                                <td class="py-3">
                                    <p class="mb-0"><s>This line of text is meant to be treated as no longer
                                            accurate.</s></p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">Addition</small></td>
                                <td class="py-3">
                                    <p class="mb-0">
                                        <ins>This line of text is meant to be treated as an addition to the
                                            document.</ins>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">Underlined</small></td>
                                <td class="py-3">
                                    <p class="mb-0"><u>This line of text will render as underlined</u></p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">Fine Print</small></td>
                                <td class="py-3">
                                    <p class="mb-0"><small>This line of text is meant to be treated as fine
                                            print.</small></p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">Bold Text</small></td>
                                <td class="py-3">
                                    <p class="mb-0"><strong>This line rendered as bold text.</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">Italicized Text</small></td>
                                <td class="py-3">
                                    <p class="mb-0"><em>This line rendered as italicized text.</em></p>
                                </td>
                            </tr>
                            <tr>
                                <td><small class="text-light fw-semibold">Abbreviations</small></td>
                                <td>
                                    <p><abbr title="attribute">attr</abbr></p>
                                    <p class="mb-0"><abbr title="HyperText Markup Language"
                                            class="initialism">HTML</abbr></p>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
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
