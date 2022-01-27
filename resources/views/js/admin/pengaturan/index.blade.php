<script>
    $(document).ready(function () {
        var table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Admin Tabel Pengaturan Izin Level Akses') }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right">>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            columns: [
                {"data":"name"},
                {"data":"banyak_permission"},
                {"data":"action"},
            ],
        });

        var table2 = $('#daftar_data_2').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Admin Tabel Pengaturan Produk Jenis Koreksi') }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"{{ (Auth::user()->can("Menambah Jenis Koreksi Stok Produk") ? "B" : "") }}>>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            buttons: [{
                className: 'btn btn-sm btn-primary ',
                text: 'Tambah Data',
                action: function (e, dt, node, config) {
                    document.location.href = "{{ route('Admin Pengaturan Produk Jenis Koreksi Create') }}";
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-default')
                }
            }],
            columns: [
                {"data":"nama"},
                {"data":"kondisi"},
                {"data":"action"},
            ],
        });

        var table3 = $('#daftar_data_3').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Admin Tabel Pengaturan Produk Kategori') }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"{{ (Auth::user()->can("Menambah Kategori Produk") ? "B" : "") }}>>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            buttons: [{
                className: 'btn btn-sm btn-primary ',
                text: 'Tambah Data',
                action: function (e, dt, node, config) {
                    document.location.href = "{{ route('Admin Pengaturan Produk Kategori Create') }}";
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-default')
                }
            }],
            columns: [
                {"data":"nama"},
                {"data":"action"},
            ],
        });

        var table4 = $('#daftar_data_4').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Admin Tabel Pengaturan Produk Satuan') }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"{{ (Auth::user()->can("Menambah Satuan Produk") ? "B" : "") }}>>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            buttons: [{
                className: 'btn btn-sm btn-primary ',
                text: 'Tambah Data',
                action: function (e, dt, node, config) {
                    document.location.href = "{{ route('Admin Pengaturan Produk Satuan Create') }}";
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-default')
                }
            }],
            columns: [
                {"data":"nama"},
                {"data":"action"},
            ],
        });

        $(document).on('click', 'TombolHapus', function () {
            swal({
                title: "Konfirmasi?",
                text: $(this).attr('pertanyaan'),
                icon: "warning",
                buttons: {
                    cancel: "Tidak",
                    confirm: {
                        text: "Ya",
                        value: "Ya",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "Ya":
                        var nilai = $(this).attr("value");
                        var url = $(this).attr("url");
                        $.ajax({
                            type: "post",
                            dataType: 'JSON',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: nilai
                            },
                            cache: false,
                            success: function (data) {
                                if (data.status == 'Valid') {
                                    swal({
                                        title: 'Berhasil',
                                        text: data.text,
                                        icon: 'success',
                                        button: "Lanjutkan"
                                    }).then(function () {
                                        document.location.href = "{{ route('Admin Pengaturan') }}";
                                    })
                                } else {
                                    swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                                }
                            }
                        });
                        break;

                    default:
                }
            });
        });
    });
</script>