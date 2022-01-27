<script>
    $(document).ready(function () {
        $('#daftar_data_1 thead th').each(function () {
            var title = $(this).text();
    
            if (title !== '') {
                $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
            } else {
                $(this).html('');
            }
        });
    
        var table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Owner Tabel Produk') }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"{{ (Auth::user()->can("Menambah Produk") ? "B" : "") }}>>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            buttons: [{
                className: 'btn btn-sm btn-primary ',
                text: 'Tambah Data',
                action: function (e, dt, node, config) {
                    document.location.href = "{{ route('Owner Produk Create') }}";
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-default')
                }
            }],
            columns: [
                {"data":"nama"},
                {"data":"kategori"},
                {"data":"stok"},
                {"data":"harga_jual"},
                {"data":"harga_jual_eceran"},
                {"data":"action"},
            ],
        });

        table1.columns().every(function () {
            var table = this;
            $('input', this.header()).on('keyup change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
            $('select', this.header()).on('change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
        });        
    });
</script>