<script>
    $(document).ready(function () {
        $(".select2").select2();
        
        $('#FormSuntingCustomer').on('submit', (function (e) {
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
                    url: "{{ route('Kasir Customer Update', $data) }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            var make_url = "{{ route('Kasir Customer Show', ['id' => '???']) }}";
                            var url = make_url.replace('???', data.id);
                            swal({
                                title: 'Berhasil',
                                text: "Customer berhasil disunting.",
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
            }
        }));
    });
</script>