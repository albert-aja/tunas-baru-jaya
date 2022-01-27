<script>
    $(document).ready(function () {
        $(".select2").select2();
        
        $('#FormSuntingProfil').on('submit', (function (e) {
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
                    url: "{{ route('Admin Profil Update') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            var url = "{{ route('Admin Profil') }}";
                            swal({
                                title: 'Berhasil',
                                text: "Profil berhasil disunting.",
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

        $("TombolTypePass").click(function () {
            var value_now = $(this).attr('value');
            console.log(value_now);
            if (value_now == 'to text') {
                $('#type_pass').removeClass('fa-eye');
                $(this).removeClass('btn-success');
                $('#type_pass').addClass('fa-eye-slash');
                $(this).addClass('btn-danger');
                $(this).attr('value', 'to pass');
                $('#password').attr('type', 'text');
            } else {
                $('#type_pass').removeClass('fa-eye-slash');
                $(this).removeClass('btn-danger');
                $('#type_pass').addClass('fa-eye');
                $(this).addClass('btn-success');
                $(this).attr('value', 'to text');
                $('#password').attr('type', 'password');
            }
        });
    });
</script>