@extends('layouts.admin')

@section('title', 'Task')
@section('main')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
@endpush

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Hover table card start -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                        <h4>@yield('title')</h4>
                        <span>Silakan kelola <code>Data @yield('title')</code> sesuai kebutuhan bisnis Anda</span>
                        </div>
                        <div>
                            <button id="createBtn" class="btn btn-success btn-sm" onclick="getModal('createModal')">
                                <i class="bi bi-plus me-2"></i>Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table id="tbl_list" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Title</th>
                                        <th width="25%">Description</th>
                                        <th>Status</th>
                                        <th>User</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@include('user.task.create')
@endsection
@push('script')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        datatableCall('tbl_list', '{{ route('tasks.index') }}', [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'title',
                name: 'title',
            },
            {
                data: 'description',
                name: 'description',
                render: function(data) {
                    return data && data.length > 120 
                        ? data.substring(0, 130) 
                        : data;
                }
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'user',
                name: 'user',
            },
            {
                data: 'action',
                name: 'action',
            },
        ]);

        $("#saveData").submit(function(e) {
            setButtonLoadingState("#saveData .btn.btn-primary", true);
            e.preventDefault();
            const kode = $("#saveData #id").val();
            let url = "{{ route('tasks.store') }}";
            const data = new FormData(this);
            if (kode !== "") {
                data.append("_method", "PUT");
                url = `/tasks/${kode}`;
            }
            const successCallback = function(response) {
                // $('#saveData #image').parent().find(".dropify-clear").trigger('click');
                setButtonLoadingState("#saveData .btn.btn-primary", false);
                handleSuccess(response, "tbl_list", "createModal");
            };
            const errorCallback = function(error) {
                setButtonLoadingState("#saveData .btn.btn-primary", false);
                handleError(error, 'dataTableId', 'modalId');
                handleValidationErrors(error, "saveData", ["title", "description", "status", "user_id"]);
            };
            
            ajaxCall(url, "POST", data, successCallback, errorCallback);
        });

        $('.summernote').summernote({
            height: 250,
            minHeight: 200,
            maxHeight: 400,
            focus: true,
            toolbar: [
                // Baris 1
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                // Baris 2
                ['insert', ['link', 'picture', 'table', 'hr']],
                ['view', ['codeview', 'help']]
            ],
            placeholder: 'Tulis deskripsi lengkap di sini...'
        });

    });
</script>
@endpush
