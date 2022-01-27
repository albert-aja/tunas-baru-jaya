<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#FormTambahPembelianItem').on('submit', (function (e) {
            e.preventDefault();

            var nama = $("#produk").val();            
            var nama = $("#kuantitas").val();            
            
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
                    url: "{{ route('Owner Pembelian Item Store', $data) }}",
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
                                document.location.href = "{{ route('Owner Pembelian Show', $data) }}";
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