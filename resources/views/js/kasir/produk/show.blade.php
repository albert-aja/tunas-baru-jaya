<script>
    $(document).ready(function () {
        $('#daftar_data_1 thead th').each(function () {
            var title = $(this).text();
    
            if (title !== '') {
                $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
            } else {
                $(this).html('');
            }
        });
    
        var table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Kasir Tabel Produk Koreksi', $data) }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"{{ (Auth::user()->can("Menambah Koreksi Stok Produk") ? "B" : "") }}>>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            buttons: [{
                className: 'btn btn-sm btn-primary ',
                text: 'Tambah Data',
                action: function (e, dt, node, config) {
                    document.location.href = "{{ route('Kasir Produk Koreksi Create', $data) }}";
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-default')
                }
            }],
            columns: [
                {"data":"jenis_koreksi"},
                {"data":"kondisi"},
                {"data":"kuantitas"},                
                {"data":"action"},
            ],
        });

        table1.columns().every(function () {
            var table = this;
            $('input', this.header()).on('keyup change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
            $('select', this.header()).on('change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
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
                                    url = data.link;
                                    swal({
                                        title: 'Berhasil',
                                        text: data.text,
                                        icon: 'success',
                                        button: "Lanjutkan"
                                    }).then(function () {
                                        document.location.href = url;
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

        $(document).on('click', 'TombolPreviewFilePDF', function () {
            swal({
                    title: 'Preview File',
                    content: {
                        element: "img",
                        attributes: {
                            src: $(this).attr('file'),
                            style: "width: 100% !important;",
                        },
                    },
                });
        });
    });
</script>