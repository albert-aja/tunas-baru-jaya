<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#waktu_transaksi').datepicker({
            autoclose: true,
            language: 'id'
        });
        
        $('#FormSuntingPenjualan').on('submit', (function (e) {
            e.preventDefault();

            var waktu_transaksi = $("#waktu_transaksi").val();            
            var no_faktur = $("#no_faktur").val();            
            
            if (!waktu_transaksi || !no_faktur) {
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
                    url: "{{ route('Owner Penjualan Update', $data) }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Penjualan berhasil disunting.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Owner Penjualan Show', $data) }}";
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