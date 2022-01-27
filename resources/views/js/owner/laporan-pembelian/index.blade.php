<script>
    $(document).ready(function () {
        $(".select2").select2();
        
        $('#waktu_transaksi_awal, #waktu_transaksi_akhir').datepicker({
            autoclose: true,
            language: 'id'
        });

        $('#FormFilterData').on('submit', (function (e) {
            e.preventDefault();

            swal({
                    title: 'Harap Tunggu',
                    text: 'Sedang memproses data.',
                    button: false,
                    showConfirmButton: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                });

            $.ajax({
                type: "post",
                dataType: 'JSON',
                url: "{{ route('Owner Laporan Pembelian Proses') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == 'Valid') {
                        var url = "{{ route('Owner Laporan Pembelian Cetak') }}";
                        
                        swal({
                            title: 'Berhasil',
                            text: "Silahkan lihat laporan.",
                            icon: 'success',
                            button: "Lanjutkan"
                        }).then(function () {
                            window.open(url, '_blank');                            
                        })
                    } else {
                        swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                    }
                }
            });
        }));
    });
</script>