<script>
    $(document).ready(function () {
        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green',      
        })
        
        $('#FormSuntingIzinLevelAkses').on('submit', (function (e) {
            e.preventDefault();

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
                url: "{{ route('Owner Pengaturan Izin Level Akses Update', $role) }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == 'Valid') {
                        swal({
                            title: 'Berhasil',
                            text: "Izin Level Akses Berhasil Disunting.",
                            icon: 'success',
                            button: "Lanjutkan"
                        }).then(function () {
                            document.location.href = "{{ route('Owner Pengaturan') }}";
                        })
                    } else {
                        swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                    }
                }
            });
        }));
    });    
</script>