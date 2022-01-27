<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#waktu_transaksi').datepicker({
            autoclose: true,
            language: 'id'
        });
        
        $(".file_bukti_transaksi").fileinput({
            language: "id",
            uploadUrl: "#",
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-xs btn-success",
            removeClass: "btn btn-xs btn-default",
            allowedFileExtensions: ['jpg', 'jpeg', 'png'],
            previewFileIcon: "<i class=fa fa-file-image></i>",
            overwriteInitial: false,
            initialPreviewAsData: false
        });

        $('#FormTambahPembelianPembayaran').on('submit', (function (e) {
            e.preventDefault();

            var waktu_transaksi = $("#waktu_transaksi").val();            
            var nominal = $("#nominal").val();            
            
            if (!waktu_transaksi || !nominal) {
                swal("Gagal", "Silahkan periksa kembali form.", "error");
            } else {
                swal({
                        title: 'Harap Tunggu',
                        text: 'Sedang menyimpan data.',
                        button: false,
                        showConfirmButton: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    });

                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "{{ route('Kasir Pembelian Pembayaran Store', $data) }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Pembayaran berhasil ditambah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Kasir Pembelian Show', $data) }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));
    });
</script>