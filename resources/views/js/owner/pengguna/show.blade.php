<script>
    $(document).ready(function () {
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
                                        document.location.href = "{{ route('Owner Pengguna') }}";
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