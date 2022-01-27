<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#FormTambahProdukJenisKoreksi').on('submit', (function (e) {
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
                    url: "{{ route('Admin Pengaturan Produk Jenis Koreksi Store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Jenis koreksi produk berhasil ditambah.",
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
            }
        }));
    });
</script>