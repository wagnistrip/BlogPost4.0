@extends('admin.layout.admin')
@section('title', 'blogs')
@section('head')
<link href="{{ asset('login/assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('login/assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                    <a href="{{route('blog.create')}}" class="btn btn-primary float-end"><i class="mdi mdi-plus"></i> Add
                        Blog</a>


                    <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                        id="delete-all">
                        <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
    @include('admin.dashboard.includes.flash-message')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100"
                                style="font-size: 14px;">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td class="table-user">
                                            <img src="{{ asset('/blog/' . $blog->image) }}" class="img-circle"
                                                alt="User Image" width="50" height="50">

                                        </td>
                                        <td>{{ $blog->name }}</td>
                                        @if ($blog->status == 1)
                                        <td><span class="label-custom label label-default">Active</span></td>
                                        @else
                                        <td><span class="label-custom label label-default">Inactive</span></td>
                                        @endif
                                        <td>
                                            <div
                                                style=" display: flex; align-items: center;justify-content:start">
                                                <a class="" href="{{ route('blog.edit', ['id' => $blog->id]) }}">
                                                    <i class="fas fa-edit"></i> <!-- Font Awesome Edit Icon -->
                                                </a>

                                                <a href="javascript:void(0);"
                                                    onclick="confirmDelete({{ $blog->id }})"
                                                    class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                </a>
                                                <form id='delete-form{{ $blog->id }}'
                                                    action='{{ route('blog.delete', $blog->id) }} ' method='POST'>
                                                    <input type='hidden' name='_token'
                                                        value='{{ csrf_token() }}'>
                                                    <input type='hidden' name='_method' value='DELETE'>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $blogs->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('login/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('login/assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('login/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('login/assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


<!-- Datatable Init js -->
<script>
    $(function() {
        $("#basic-datatable").DataTable({
            paging: !1,
            pageLength: 20,
            lengthChange: !1,
            searching: !1,
            ordering: !0,
            info: !1,
            autoWidth: !1,
            responsive: !0,
            order: [
                [0, "asc"]
            ],
            columnDefs: [{
                targets: [0],
                visible: !0,
                searchable: !0
            }],
            columns: [{
                orderable: !1
            }, {
                orderable: !0
            }, {
                orderable: !0
            }, {
                orderable: !0
            }, {
                orderable: !1
            }, ]
        })
    });
</script>

<script type="text/javascript">
    $("#all-rows").change(function() {
        var c = [];
        this.checked ? ($(".checkbox-row").prop("checked", !0), $("input:checkbox[name=rows]:checked").each(
            function() {
                c.push($(this).val())
            }), $("#delete-all").css("display", "block")) : ($(".checkbox-row").prop("checked", !1),
            c = [], $("#delete-all").css("display", "none"))
    });

    $(".checkbox-row").change(function() {
        rows = [], $("input:checkbox[name=rows]:checked").each(function() {
            rows.push($(this).val())
        }), 0 == rows.length ? $("#delete-all").css("display", "none") : $("#delete-all").css("display",
            "block")
    });

    $("#delete-all").click(function(e) {
        rows = [], $("input:checkbox[name=rows]:checked").each(function() {
            rows.push($(this).val())
        }), Swal.fire({
            title: "Are you sure?",
            text: "You want to delete selected rows!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete selected!"
        }).then(t => {
            t.isConfirmed && ($("#delete-all").text("Deleting..."), e.preventDefault(), $.ajax({
                type: "POST",
                dataType: "json",
                url: "",
                data: {
                    employers: rows,
                    _token: "{{ csrf_token() }}"
                },
                success: function(e) {
                    location.reload()
                }
            }))
        })
    });

    function confirmDelete(e) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete it!"
        }).then(t => {
            t.isConfirmed && document.getElementById("delete-form" + e).submit()
        })
    }

    $(".change-password").click(function() {
        var a = $(this).data("id"),
            t = $(this).data("name");
        $("#id").val(a), $("#volunteer_name").text(t), $("#volunteer_name_input").val(t)
    });
</script>

@error('password')
<script>
    $(document).ready(function() {
        $('#modal-password').modal('show');
    });
</script>
@enderror
@endpush