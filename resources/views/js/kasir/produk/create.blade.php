<script>
    $(document).ready(function () {
        $(".select2").select2();

        $(".foto-produk").fileinput({
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
        
        $('#FormTambahProduk').on('submit', (function (e) {
            e.preventDefault();

            var nama = $("#nama").val();            
            
            if (!nama) {
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
                    url: "{{ route('Kasir Produk Store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Produk berhasil ditambah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Kasir Produk') }}";
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