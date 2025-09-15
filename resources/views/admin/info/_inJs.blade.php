<!-- Jquery and Bootstrap Valication -->
<script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

<!-- Select 2 -->
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
{{-- File Pond --}}
<script src="{{asset('assets/js/filepond/filepond.js')}}"></script>

<script>
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

        
    $(function() {

        function toggle(className, displayState) {
            var elements = document.getElementsByClassName(className)

            for (var i = 0; i < elements.length; i++) {
                elements[i].style.display = displayState;
            }
        }

        // Get a reference to the file input element
        const inputElement = document.querySelector('input[id="data_file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                process: {
                    url: '{{ route("file.upload") }}'
                    , headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
                , revert: {
                    url: '{{ route("file.destroy", 1) }}'
                    , method: 'DELETE'
                    , headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        , '_method': 'DELETE'
                    }
                }
            }
            , onaddfilestart: (file) => {
                isLoadingCheck();
            }
            , onprocessfile: (files) => {
                isLoadingCheck();
            }
        });

        function isLoadingCheck() {
            var isLoading = pond.getFiles().filter(x => x.status !== 5).length !== 0;
            if (isLoading) {
                $('#storeUser').attr("disabled", "disabled");
            } else {
                $('#storeUser').removeAttr("disabled");
            }
        }


        $.fn.modal.Constructor.prototype.enforceFocus = function() {};

        'use strict';

        // Do this before you initialize any of your modals
        $(".select2def").select2({
            theme: 'bootstrap-5',
            dropdownParent: $("#defModal")
        });

        $('.select2-search-kategori').select2({
            theme: 'bootstrap-5',
            dropdownParent: $("#defModal"),
            // ajax: {
            //     url: "/search/kategori",
            //     dataType: 'json',
            //     delay: 250,
            //     data: function(params) {
            //         return {
            //             q: params.term, // search term
            //             page: params.page
            //         };
            //     },
            //     processResults: function(data, params) {
            //         console.log('data kategori');
            //         console.log(data);
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: item.name,
            //                     id: item.id_data_kategori,
            //                 }
            //             })
            //         };
            //     },
            //     delay: 250,
            //     cache: true
            // },
            placeholder: 'Cari Item Kategori',
            // minimumInputLength: 5,
            "language": {
                "noResults": function(res, data) {
                    // console.log(res, data);
                    return "Tidak ditemukan <a class='btn btn-sm btn-danger add-new-kategori'>Tambahkan</a>";
                }
            },
            escapeMarkup: function(markup) {
                // console.log('markup');
                // console.log(markup);
                return markup;
            }
        });

        $('.select2-search-instansi').select2({
            theme: 'bootstrap-5',
            dropdownParent: $("#defModal"),
            // ajax: {
            //     url: "/search/instansi",
            //     dataType: 'json',
            //     delay: 250,
            //     data: function(params) {
            //         return {
            //             q: params.term, // search term
            //             page: params.page
            //         };
            //     },
            //     processResults: function(data, params) {
            //         console.log('data instansi');
            //         console.log(data);
            //         return {
            //             results: $.map(data, function(item) {
            //                 return {
            //                     text: item.name,
            //                     id: item.id_data_instansi,
            //                 }
            //             })
            //         };
            //     },
            //     delay: 250,
            //     cache: true
            // },
            placeholder: 'Cari Data Instansi / Seksi',
            // minimumInputLength: 5,
            "language": {
                "noResults": function(res, data) {
                    // console.log(res, data);
                    return "Tidak ditemukan <a class='btn btn-sm btn-danger add-new-instansi'>Tambahkan</a>";
                }
            },
            escapeMarkup: function(markup) {
                // console.log('markup');
                // console.log(markup);
                return markup;
            }
        });

        $(document).on('click', '.add-new-kategori', function(e) {
            console.log('add new kategori clicked');
            var kategoriName = $('.select2-search__field').val();
            console.log('data');
            console.log(kategoriName);
            $('#id_data_kategori').select2('close');
            $('#defForm').block({
                message: `Loading...`
            });

            $.ajax({
                type: 'PUT',
                url: `{{route('kategori.add')}}`,
                data: {
                    kategori_name: kategoriName
                },
                dataType: 'json', // let's set the expected response format
                success: function(data) {
                    console.log(data);
                    if (!data.success) {
                        Swal.fire(
                            'Error!', data.message, 'error'
                        );
                    } else {
                        var dataKategori = data.data;
                        console.log('dataKategori');
                        console.log(dataKategori);

                        var newOption = new Option(dataKategori.name, dataKategori.id_data_kategori, true, true);
                        $('.select2-search-kategori').append(newOption).trigger('change');
                        
                        $('#defForm').unblock();
                    }

                },
                error: function(err) {
                    if (err.status ==
                        422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $('.ajax-invalid').remove();
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="ajax-invalid" style="color: red;">' +
                                error[0] + '</span>'));
                        });
                    } else if (err.status == 403) {
                        Swal.fire(
                            'Unauthorized!',
                            'You are unauthorized to do the action',
                            'warning'
                        );

                    }
                }
            });
        });


        $(document).on('click', '.add-new-instansi', function(e) {
            console.log('add new instansi clicked');
            var instansiName = $('.select2-search__field').val();
            console.log('data');
            console.log(instansiName);
            $('#id_data_instansi').select2('close');
            $('#defForm').block({
                message: `Loading...`
            });

            $.ajax({
                type: 'PUT',
                url: `{{route('instansi.add')}}`,
                data: {
                    instansi_name: instansiName
                },
                dataType: 'json', // let's set the expected response format
                success: function(data) {
                    setTimeout(function() {
                        console.log(data);
                        if (!data.success) {
                            Swal.fire(
                                'Error!', data.message, 'error'
                            );
                        } else {
                            var dataInstansi = data.data;
                            console.log('dataInstansi');
                            console.log(dataInstansi);
                            var newOption = new Option(dataInstansi.name, dataInstansi.id_data_instansi, true, true);
                            $('.select2-search-instansi').append(newOption).trigger('change');

                            $('#defForm').unblock();
                            }
                    }, 100);

                },
                error: function(err) {
                    if (err.status ==
                        422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $('.ajax-invalid').remove();
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="ajax-invalid" style="color: red;">' +
                                error[0] + '</span>'));
                        });
                    } else if (err.status == 403) {
                        Swal.fire(
                            'Unauthorized!',
                            'You are unauthorized to do the action',
                            'warning'
                        );

                    }
                }
            });
        });

        var lastQueryStringKategori = '';
        jQuery('.select2-search-kategori').on('select2:open', function () {
            console.log('opening lastQueryStringKategori:  ' + lastQueryStringKategori);
            if (lastQueryStringKategori) {
                jQuery('.select2-search').find('input').focus().val(lastQueryStringKategori).trigger('input');
            } 
        });

        jQuery('.select2-search-kategori').on('select2:closing', function () {
            console.log('closing lastQueryStringKategori:  ' + lastQueryStringKategori);

            lastQueryStringKategori = jQuery('.select2-search').find('input').val();
        });

        var lastQueryStringInstansi = '';
        jQuery('.select2-search-instansi').on('select2:open', function () {
            console.log('opening lastQueryStringInstansi:  ' + lastQueryStringInstansi);
            if (lastQueryStringInstansi) {
                jQuery('.select2-search').find('input').focus().val(lastQueryStringInstansi).trigger('input');
            }
        });

        jQuery('.select2-search-instansi').on('select2:closing', function () {
            console.log('closing lastQueryStringInstansi:  ' + lastQueryStringInstansi);

            lastQueryStringInstansi = jQuery('.select2-search').find('input').val();
        });

        // Initiate Table
        var defTbl = $("#defTbl").DataTable({
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
                    text: '<i class="fa fa-plus-circle"></i> Tambah'
                    , attr: {
                        'title': 'Entry New Data'
                        , 'data-bs-original-title': 'Entry New Data'
                        , 'data-bs-target': '#defModal'
                        , 'data-bs-toggle': 'modal'
                        , 'data-bs-backdrop': 'static'
                        , 'data-bs-keyboard': 'false'
                        , 'data-bs-title': 'Tambah Layanan Baru'
                        , 'data-title': 'Tambah Layanan Baru'
                        , 'type': 'button'
                        , 'id': 'addBtn'
                        , 'class': 'btn btn-primary'
                    }
                    , action: function(e, dt, node, config) {
                        // alert('Button activated');
                    }
                }
                , {
                    text: '<i class="fa fa-refresh"></i>  Reload'
                    , attr: {
                        'title': 'Refresh Table'
                        , 'class': 'btn btn-secondary'
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
            , scrollX: true
            , autoWidth: false
            , ajax: "{{ route('info.index') }}"
            , columns: [{
                data: 'DT_RowIndex'
                , name: 'DT_RowIndex'
                , className: 'text-center'
            }, {
                data: 'nama_file'
                , name: 'nama_file'
            }, {
                data: 'jenisklasifikasiinformasi'
                , name: 'jenisklasifikasiinformasi'
            }, {
                data: 'instansipenanggungjawab'
                , name: 'instansipenanggungjawab'
            }, {
                data: 'fileketerangan'
                , name: 'fileketerangan'
            }, {
                data: 'tahun_tempat'
                , name: 'tahun_tempat'
            }, {
                data: 'datastatus'
                , name: 'datastatus'
            }, {
                data: 'action'
                , name: 'action'
                , className: 'text-center'
            }, ]
            , columnDefs: [{
                    orderable: false
                    , targets: [0, 1, 2, 3, 4, 5]
                }
                , {
                    targets: [0, 2, 3, 5, 6]
                    , className: 'text-center txtgray'
                }

            , ]
        , });
        // Validate Form
        var checkedRequired = true;
        $('#defForm').validate({
            ignore: []
            , rules: {
                nama_file: {
                    required: true
                , }
                , keterangan: {
                    required: true
                , }
                , data_file: {
                    required: function(element) {
                        if ($("#data_file_required").val() == 'true') {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
            , messages: {
                // id_data_seksi: "Data Seksi Harap diisi"
                // , id_data_kategori: "Data Kategori Harap diisi"
                // , id_data_label: "Data Label Harap diisi", 
                nama_file: "Nama Harap diisi"
                , keterangan: "Keterangan Harap diisi"
                , data_file: "Data Berkas Harap diunggah"
            }
            , errorElement: 'span'
            , errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
            , highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            }
            , unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // On Add
        $("#addBtn").on("click", function() {
            pond.removeFile(pond.getFiles());
            toggle('berkas-upload', 'none');
            checkedRequired = true;
            $("#data_file_required").val('true');
            // $('#defForm')[0].reset();

            $('#defForm :text').val('');

            $('#id_data_file').val('');
            $("#modalTitle").html('Entry {{ $title }}');
            var box = $(".modal-footer");
            box.empty();
            box.append(
                '<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>' +
                '<button id="storeUser" type="submit" class="btn btn-primary">Simpan</button>');
            $("#storeUser").on("click", function(event) {
                event.preventDefault();
                console.log('formdata');
                console.log($("#defForm").serializeArray());
                console.log('is form valid:')
                console.log($("#defForm").valid());
                if ($("#defForm").valid()) {
                    var formdata = $("#defForm")
                        .serialize(); // here $(this) refere to the form its submitting
                    console.log(formdata);
                    $.ajax({
                        type: 'POST'
                        , url: "{{ route('info.store') }}"
                        , data: formdata, // here $(this) refers to the ajax object not form
                        dataType: 'json', // let's set the expected response format
                        success: function(data) {
                            console.log(data);
                            if (data.success) {
                                $('#defModal').modal('hide');
                                Swal.fire(
                                    'Great!', 'The data has been saved!'
                                    , 'success'
                                );
                            } else {
                                Swal.fire(
                                    'Warning!', data.message, 'warning'
                                );
                            }
                            defTbl.ajax.reload(null, false)
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
                }
            });
        });
        // On Edit
        $(document).on('click', '#editBtn', function(e) {
            pond.removeFile(pond.getFiles());
            toggle('berkas-upload', 'block');
            console.log('btnedit');
            $("#modalTitle").html('Modifikasi {{ $title }}');
            var box = $(".modal-footer");
            box.empty();
            box.append(
                '<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>' +
                '<button id="updateItem" type="submit" class="btn btn-primary">Update</button>');
            var data = defTbl.row($(this).parents('tr')).data();
            console.log(data);
            // Fill Data
            $('#id_data_file').val(data.id_data_file);
            $('#id_data_klasifikasi').val(data.id_data_klasifikasi).trigger("change");
            $('#id_data_sub_klasifikasi').val(data.id_data_sub_klasifikasi).trigger("change");
            $('#id_data_kategori').val(data.id_data_kategori).trigger("change");
            lastQueryStringKategori = $('#id_data_kategori').select2('data')[0].text;

            $('#id_data_instansi').val(data.id_data_instansi).trigger("change");
            lastQueryStringInstansi = $('#id_data_instansi').select2('data')[0].text;

            $('#nama_file').val(data.nama_file);
            $('#tahun').val(data.tahun);
            $('#tempat').val(data.tempat);
            $('#penanggung_jawab').val(data.penanggung_jawab);
            $('#keterangan').val(data.keterangan);
            $('#akses').val(data.akses).trigger("change");
            $('#bentuk').val(data.bentuk).trigger("change");
            iddatakategori = data.id_data_kategori;

            // Berkas Lama
            $('#string_url').attr('href', data.url_file);
            $('#string_url').html(data.nama_file + '.' + data.ext);
            $('#string_keterangan').html(data.keterangan);


            toggle('berkas', 'none');
            $("#data_file_required").val('false');


            $('#nama').val(data.nama);
            $('input[type=checkbox]').each(function() {
                this.checked = false;
            });
            $.each(data.roles, function(index, value) {
                $('input[name="roles[]"][value="' + value.toString() + '"]').prop("checked"
                    , true);
            });

            $("#updateItem").on("click", function(event) {
                console.log('jancuk');
                event.preventDefault();
                console.log('is form valid:')
                console.log($("#defForm").valid());
                console.log('checkedRequired');
                console.log(checkedRequired);

                if ($("#defForm").valid()) {
                    var formdata = $("#defForm")
                        .serialize(); // here $(this) refere to the form its submitting
                    console.log(formdata);
                    $.ajax({
                        type: 'POST'
                        , url: "{{ route('info.store') }}"
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
                }
            });
        });

        // On Upload
        $(document).on('click', '#uploadBtn', function(e) {
            console.log('uploadbtn');
            $("#modalTitle").html('Upload Ulang {{ $title }}');
            var box = $(".modal-footer");
            box.empty();
            box.append(
                '<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>' +
                '<button id="updateItem" type="submit" class="btn btn-primary">Update</button>');
            var data = defTbl.row($(this).parents('tr')).data();
            console.log(data);
            // Fill Data
            $('#id_data_file').val(data.id_data_file);
            $('#string_url').attr('href', data.url_file);
            $('#string_url').html(data.nama_file + '.' + data.ext);
            $('#string_keterangan').html(data.keterangan);



            toggle('nonberkas', 'none');
            toggle('berkas', 'block');
            toggle('berkas-upload', 'block');
            $("#data_file_required").val('true');


            $('#nama').val(data.nama);
            $('input[type=checkbox]').each(function() {
                this.checked = false;
            });
            $.each(data.roles, function(index, value) {
                $('input[name="roles[]"][value="' + value.toString() + '"]').prop("checked"
                    , true);
            });

            $("#updateItem").on("click", function(event) {
                console.log('jancuk');
                event.preventDefault();

                $("#defForm").valid();
                console.log($('#data_file').val());
                console.log($("#defForm")
                    .serialize());

                if ($('#data_file').val() != '') {
                    var formdata = $("#defForm")
                        .serialize() + "&upload_file=true"; // here $(this) refere to the form its submitting
                    console.log(formdata);
                    $.ajax({
                        type: 'POST'
                        , url: "{{ route('info.store') }}"
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
                }
            });
        });

        // On Switch
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

                    var formdata = $("#defForm").serialize() + "&switch_status=true&id_data_file_switch=" + data.id_data_file + "&switch_status=" + $(this).data('status');
                    console.log(formdata);

                    $.ajax({
                        type: 'POST'
                        , url: "{{ route('info.store') }}"
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

        // On Delete
        $(document).on('click', '#deleteBtn', function(e) {
            var data = defTbl.row($(this).parents('tr')).data();
            console.log(data);
            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin akan melakukan penghapusan data?'
                , text: "Anda tidak dapat mengembalikan file yang sudah dihapus!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonText: 'Ya, hapus!'
                , cancelButtonText: 'Tidak, batalkan!'
                , reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var formdata = $("#defForm").serialize();
                    var url = '{{ route("info.destroy", ":id") }}';
                    url = url.replace(':id', data.id_data_label);
                    $.ajax({
                        type: 'DELETE'
                        , url: url
                        , data: formdata, // here $(this) refers to the ajax object not form
                        dataType: 'json', // let's set the expected response format
                        success: function(data) {
                            console.log(data);
                            if (data.success) {
                                $('#defModal').modal('hide');
                                defTbl.ajax.reload(null, false);
                                swalWithBootstrapButtons.fire(
                                    'Deleted!'
                                    , 'The {{$title}} has been deleted.'
                                    , 'success'
                                )
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
        var iddatakategori = 0;
        // Dependent Get Category
        // $('#id_data_seksi').on('change', function() {
        //     $('#id_data_label').empty();
        //     $('#id_data_label').append('<option value="">-- Pilih Label --</option>');
        //     var id_data_seksi = $(this).val();
        //     if (id_data_seksi) {
        //         $.ajax({
        //             url: '/dependent/get/category/' + id_data_seksi
        //             , type: "GET"
        //             , data: {
        //                 "_token": "{{ csrf_token() }}"
        //             }
        //             , dataType: "json"
        //             , success: function(data) {
        //                 if (data) {
        //                     $('#id_data_kategori').empty();
        //                     if (data.length == 0) {
        //                         $('#id_data_kategori').append('<option value="">!! Data Kategori Belum ada !!</option>');
        //                     } else {
        //                         $('#id_data_kategori').append('<option value="">-- Pilih Kategori --</option>');
        //                         $.each(data, function(key, item) {
        //                             $('select[name="id_data_kategori"]').append('<option value="' + item.id_data_kategori + '">' + item.nama + '</option>');
        //                         });
        //                     }
        //                 } else {
        //                     $('#id_data_kategori').empty();
        //                 }

        //                 $('#id_data_kategori').val(iddatakategori).trigger("change");
        //             }
        //         });
        //     } else {
        //         $('#course').empty();
        //     }
        // });

        // Dependent Get Category
        // $('#id_data_kategori').on('change', function() {
        //     var id_data_kategori = $(this).val();
        //     if (id_data_kategori) {
        //         $.ajax({
        //             url: '/dependent/get/label/' + id_data_kategori
        //             , type: "GET"
        //             , data: {
        //                 "_token": "{{ csrf_token() }}"
        //             }
        //             , dataType: "json"
        //             , success: function(data) {
        //                 if (data) {
        //                     $('#id_data_label').empty();
        //                     if (data.length == 0) {
        //                         $('#id_data_label').append('<option value="">!! Data Label Belum ada !!</option>');
        //                     } else {
        //                         $('#id_data_label').append('<option value="">-- Pilih Data Label --</option>');
        //                         $.each(data, function(key, item) {
        //                             $('select[name="id_data_label"]').append('<option value="' + item.id_data_label + '">' + item.nama + '</option>');
        //                         });
        //                     }
        //                 } else {
        //                     $('#id_data_label').empty();

        //                 }
        //             }
        //         });
        //     } else {
        //         $('#course').empty();
        //     }
        // });


    });

</script>

<script>

</script>