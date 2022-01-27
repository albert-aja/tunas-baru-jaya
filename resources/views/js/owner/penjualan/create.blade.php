<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#waktu_transaksi').datepicker({
            autoclose: true,
            language: 'id'
        });
        
        $('#FormTambahPenjualan').on('submit', (function (e) {
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
                    url: "{{ route('Owner Penjualan Store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Penjualan berhasil ditambah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Owner Penjualan') }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));

        $("#pencarian_produk").change(function () {
            var count_produk = parseInt($('#count_produk').val());
            var next_produk = count_produk + 1;
            var req = "Form Produk Penjualan";
            var produk = $(this).val();            

            $.ajax({
                type: "post",
                url: "{{ route('Owner Penjualan Req') }}",
                data: {
                    req: req,
                    next_produk: next_produk,
                    "_token": "{{ csrf_token() }}",
                    produk: produk,
                },
                cache: false,
                success: function (data) {
                    $("#konten_produk").append(data);
                }
            });

            $('#count_produk').val(next_produk);
            $(this).select2("val", "");
        });

        $(document).on('change', '.update_subtotal', function () {
            var urutan = $(this).attr('urutan');
            var harga_jual = parseFloat($('#harga_jual_'+urutan).val());
            var kuantitas = parseFloat($('#kuantitas_'+urutan).val());
            var subtotal = harga_jual * kuantitas;
            var total = 0;
            $('#subtotal_field_'+urutan).val(subtotal);
            $('.subtotal').each(function () {
                var item = parseFloat($(this).val());
                total = total+item;                
            });
            $('#total').val(total);
        });

        $(document).on('click', 'TombolHapusProduk', function () {
            var urutan = $(this).attr('urutan');
            $('#produk_' + urutan).remove();
            $('#divider_' + urutan).remove();
        });
    });
</script>