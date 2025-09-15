@extends('layouts.admin.master')
@section('title', 'Daftar Permohonan')


@section('_styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<style>
    .profile .profile-edit img {
        max-width: 120px;
    }

    #profile_photo_src {
        max-width: 120px;
    }

    .profile-edit {
        max-width: 120px;
    }

    .preserveLines {
        white-space: pre-wrap;
    }
</style>
@endsection





@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ $br1 }}</a></li>
                <li class="breadcrumb-item active">{{ $br2 }}</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Kegiatan</h5>

                        <table class='table table-bordered display' id="defTbl"
                            style="width:100%; font-size:11pt!important;">
                            <thead>
                                <th class="text-center" style="vertical-align: middle">No</th>
                                <th class="text-center" style="vertical-align: middle">Jenis Pemohon</th>
                                <th class="text-center" style="vertical-align: middle">Nama Pemohon</th>
                                <th class="text-center" style="vertical-align: middle">Rincian</th>
                                <th class="text-center" style="vertical-align: middle">Tujuan Penggunaan</th>
                                <th class="text-center" style="vertical-align: middle">Status</th>
                                <th class="text-center" style="vertical-align: middle">Aksi</th>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('admin.permohonan._modal')


</main>




@endsection


@section('_scripts')


<!-- Styles -->
{{--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>





<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" language="javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>



<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success px-3 mx-3'
                , cancelButton: 'btn btn-danger px-3 mx-3'
            }
            , buttonsStyling: false
        });

        var defTbl = $('#defTbl').DataTable({
            dom: 'Bfrtip'
            , sort: false
            , order: false
            , lengthMenu: [
                [10, 25, 50, -1]
                , ['10 rows', '25 rows', '50 rows', 'Show all']
            ]
            , buttons: [
                'pageLength'
                , {
                    text: '<i class="fa fa-refresh"></i>  Reload'
                    , attr: {
                        'title': 'Refresh Table'
                        , 'class': 'btn btn-warning'
                    }
                    , action: function(e, dt, node, config) {
                        dt.ajax.reload();
                        $('#defTbl').block({
                            message: `Loading...`
                        });
                        setTimeout(function() {
                            $('#defTbl').unblock();
                        }, 1500);
                    }
                }
            ]
            , responsive: false
            // , scrollX: true
            , autoWidth: false
            , processing: true
            , serverSide: true
            , ajax: '{{ route("permohonan.index") }}'
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , searchable: false
                    , className: 'text-center'
                }
                , {
                    data: 'jenis_pemohon'
                    , name: 'jenis_pemohon'
                    , className: 'text-center'
                }
                , {
                    data: 'nama_pemohon'
                    , name: 'nama_pemohon'
                }
                , {
                    data: 'rincian_informasi'
                    , name: 'rincian_informasi'
                }
                , {
                    data: 'tujuan_penggunaan_informasi'
                    , name: 'tujuan_penggunaan_informasi'
                }
                , {
                    data: 'status_permohonan'
                    , name: 'status_permohonan'
                    , className: 'text-center'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                }
            ]
        });

        $(document).on('click', '#switchBtn', function(e) {
            var data = defTbl.row($(this).parents('tr')).data();
            console.log(data);
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin akan mengubah status menjadi ' + $(this).data('status') + '?'
                , text: "Status yang sudah diubah akan tercatat!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonText: 'Ya, Ubah!'
                , cancelButtonText: 'Tidak, batalkan!'
                , reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    var formdata = $("#defForm").serialize() + "&switch_status=true&id_permohonan=" + data.id_permohonan + "&status_permohonan=" + $(this).data('status');
                    console.log(formdata);

                    $.ajax({
                        type: 'POST'
                        , url: "{{ route('permohonan.status.switch') }}"
                        , data: formdata, // here $(this) refers to the ajax object not form
                        dataType: 'json', // let's set the expected response format
                        success: function(data) {
                            console.log(data);
                            if (data.success) {
                                $('#defModal').modal('hide');
                                defTbl.ajax.reload(null, false);
                                Swal.fire(
                                    'Great!', 'The data has been updated!'
                                    , 'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!', data.message, 'error'
                                );
                            }
                        }
                        , error: function(err) {
                            if (err.status ==
                                422
                            ) { // when status code is 422, it's a validation issue
                                console.log(err.responseJSON);
                                // you can loop through the errors object and show it to the user
                                console.warn(err.responseJSON.errors);
                                // display errors on each form field
                                $('.ajax-invalid').remove();
                                $.each(err.responseJSON.errors, function(i
                                    , error) {
                                    var el = $(document).find('[name="' +
                                        i + '"]');
                                    el.after($('<span class="ajax-invalid" style="color: red;">' +
                                        error[0] + '</span>'));
                                });
                            } else if (err.status == 403) {
                                Swal.fire(
                                    'Unauthorized!'
                                    , 'You are unauthorized to do the action'
                                    , 'warning'
                                );
                            }
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled', 'The {{$title}} data is safe :)', 'error'
                    )
                }
            });
        });

        $(document).on('click', '#editBtn', function(e) {
            console.log('btnedit');
            $("#modalTitle").html('Lihat Data Permohonan');
            var box = $(".modal-footer");
            box.empty();
            box.append(
                '<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>');
            var data = defTbl.row($(this).parents('tr')).data();
            console.log(data);
            // Fill Data
            $('#jenis_pemohon').val(data.jenis_pemohon);
            $('#jenis_identitas').val(data.jenis_identitas);
            $('#nomor_identitas').val(data.nomor_identitas);
            $('#nama_pemohon').val(data.nama_pemohon);
            $('#email').val(data.email);
            $('#no_telp').val(data.no_telp);
            $('#alamat').val(data.alamat);
            $('#pekerjaan').val(data.pekerjaan);
            $('#foto').val(data.foto);
            $('#identity_url').val(data.identity_url);
            $('#rincian_informasi').val(data.rincian_informasi);
            $('#tujuan_penggunaan_informasi').val(data.tujuan_penggunaan_informasi);
            $('#cara_pemakaian_informasi').val(data.cara_pemakaian_informasi);
            $('#cara_memperoleh_informasi').val(data.cara_memperoleh_informasi);
            $('#bentuk_informasi').val(data.bentuk_informasi);
            $('#cara_mendapatkan_salinan').val(data.cara_mendapatkan_salinan);

            $('#identity_url').attr('href', data.identity_url)


            $('#nama').val(data.nama);
            $('input[type=checkbox]').each(function() {
                this.checked = false;
            });
            $.each(data.roles, function(index, value) {
                $('input[name="roles[]"][value="' + value.toString() + '"]').prop("checked"
                    , true);
            });

        });
    });

</script>

@endsection