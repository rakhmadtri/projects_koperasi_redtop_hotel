<!--================ Content Wrapper===========================================-->
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kode Penjualan</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th class="span3">
            <a href="<?php echo site_url('penjualan/pages_tambah_penjualan')?>" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if(isset($data_penjualan)){
        foreach($data_penjualan as $row){
            ?>
            <tr class="gradeX">
                <td><?php echo $no++; ?></td>
                <td><?php echo date("d M Y",strtotime($row->tanggal_penjualan)); ?></td>
                <td><?php echo $row->kd_penjualan; ?></td>
                <td><?php echo $row->jumlah; ?> Items</td>
                <td>
                    <a class="btn btn-mini btnPrint" href="<?php echo site_url('cetak/print_penjualan/'.$row['order_id'])?>">
                        <i class="icon-print"></i> Print</a>
                </td>
            </tr>
        <?php }
    }
    ?>

    </tbody>
</table>



