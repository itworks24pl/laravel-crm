<?php
?>
vendro
<div class="container mt-5">
    <h2 class="mb-4">Laravel Yajra Datatables Example</h2>
    <table id="myTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    // console.log($);
    // $(function () {
    //     var table = $('#myTable').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: "{{ route('laravel-crm.product-return.index') }}",
    //         columns: [
    //             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //             {data: 'product_code', name: 'product_code'},
    //             {data: 'name', name: 'name'},
    //         ]
    //     });  
    //     const editor = new DataTable.Editor({
    //         ajax: '../php/staff.php',
    //         fields: [
    //             {
    //                 label: 'First name:',
    //                 name: 'name'
    //             },
    //         ]
    //     });   
    //     table.on('click', 'tbody td:not(:first-child)', function (e) {
    //         editor.inline(this);        
    //     });   
    // });
</script>
