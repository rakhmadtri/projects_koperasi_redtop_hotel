SELECT ma.`no_anggota`,ma.`nik`,md.`nama_departemen`,ma.`nama`,
	IFNULL(sub_untung_pinjaman.untung_pinjaman,0) AS 'pinjaman_koperasi',
	IFNULL(sub_untung_penjualan_anggota.untung_penjualan,0) AS 'pinjaman_belanja'
FROM master_anggota ma
JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
JOIN
(
	SELECT ma.`nik`,ma.`nama`,SUM(a.`jumlah`) AS hutang_awal,SUM(a.`cicilan_perbulan`) AS hutang_akhir,
		SUM(a.`cicilan_perbulan`)-a.`jumlah` AS untung_pinjaman
	FROM cicilan a
	JOIN transaksi_pinjaman tp ON tp.id=a.order_id AND a.keterangan="transaksi_pinjaman"
	JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
	WHERE 1
	AND a.`status`='lunas'
	AND a.`keterangan`='transaksi_pinjaman'
	AND update_timestamp IS NOT NULL
	GROUP BY a.`no_anggota`,a.`order_id`
) sub_untung_pinjaman
	ON sub_untung_pinjaman.no_anggota=ma.`no_anggota`
LEFT JOIN
(
	SELECT ma.`nik`,ma.`nama`,SUM((qty*selling_price)-(qty*buying_price)) AS untung_penjualan 
	FROM cicilan a
	JOIN transaksi tr ON a.order_id=tr.order_id AND a.keterangan='transaksi_penjualan'
	JOIN transaksi_detail td ON td.order_id=tr.order_id 
	JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
	WHERE 1
	AND a.`status`='lunas' 
	AND a.`keterangan`='transaksi_penjualan'
	AND update_timestamp IS NOT NULL
	GROUP BY a.`no_anggota`
) sub_untung_penjualan_anggota 
	ON sub_hutang_penjualan.no_anggota=ma.`no_anggota`	
LEFT JOIN
	(
	SELECT ma.`no_anggota`,ma.`nama`,
	(SELECT nominal FROM master_jenis_simpanan mjs WHERE mjs.prioritas=2) AS simpanan
	FROM master_anggota ma
	WHERE 1
	AND ma.`hapus`=0
	AND ma.`no_anggota` NOT IN
	(
		SELECT ts.`no_anggota`
			#ts.`no_anggota`,tsd.`kode_simpanan`,tsd.`kode_jenis_simpanan`,mjs.`nama_simpanan`,ts.`created_timestamp`
			FROM transaksi_simpanan ts
			JOIN transaksi_simpanan_detail tsd ON tsd.`kode_simpanan`=ts.`kode_simpanan`
			JOIN master_jenis_simpanan mjs ON mjs.`kode_jenis_simpanan`=tsd.`kode_jenis_simpanan`
			WHERE 1
			AND DATE_FORMAT(ts.`created_timestamp`,'%Y-%m')='2016-02'
	)
) sub_iuran
	ON sub_iuran.no_anggota=ma.`no_anggota`
WHERE 1
AND ma.`hapus`=0;


SELECT a.`jumlah`/tp.`lama_cicilan`,
SUM(a.jumlah/tp.lama_cicilan),
	SUM(a.`jumlah`/tp.lama_cicilan) AS hutang_awal,
	SUM(a.`cicilan_perbulan`) AS hutang_akhir,
	SUM(a.total_pinjaman)AS untung_pinjaman
FROM cicilan a
JOIN transaksi_pinjaman tp ON tp.id=a.order_id AND a.keterangan="transaksi_pinjaman"
JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
WHERE 1
AND a.`status`='lunas'
AND a.`keterangan`='transaksi_pinjaman'
AND update_timestamp IS NOT NULL
GROUP BY a.`no_anggota`,a.`order_id`
	UNION
SELECT 
	SUM(a.`jumlah`) AS hutang_awal2,
	SUM(a.`cicilan_perbulan`) AS hutang_akhir2,
	SUM(a.`cicilan_perbulan`)-a.`jumlah` AS untung_pinjaman2
FROM cicilan a
JOIN transaksi tr ON a.order_id=tr.order_id AND a.keterangan='transaksi_penjualan'
JOIN transaksi_detail td ON td.order_id=tr.order_id 
JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
WHERE 1
AND a.`status`='lunas' 
AND a.`keterangan`='transaksi_penjualan'
AND update_timestamp IS NOT NULL
GROUP BY a.`no_anggota`
;

# Query Result keuntungan dari pinjaman
SELECT tp.`id`,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
	SUM(tp.`bunga`) AS 'untung_by_order',
	'TRANSAKSI PINJAMAN' AS keterangan
FROM transaksi_pinjaman tp 
JOIN master_anggota ma ON ma.`no_anggota`=tp.`no_anggota`
JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
WHERE 1
AND tp.`status`='lunas'
GROUP BY ma.`no_anggota`,tp.`id`
UNION
# Query Result keuntungan dari penjualan
SELECT tr.order_id,ma.`nama`,mj.`nama_jabatan`,md.`nama_departemen`,
	#sum(td.qty) as 'banyak_qty',count(*) as 'banyak_pesan',
	SUM((`selling_price`-`buying_price`)*qty) AS 'untung_by_order',
	'TRANSAKSI PENJUALAN' AS keterangan
FROM transaksi tr
JOIN transaksi_detail td ON tr.`order_id`=td.`order_id`
JOIN master_anggota ma ON ma.`no_anggota`=tr.`kode_customer`
JOIN master_jabatan mj ON mj.`kode_jabatan`=ma.`jabatan`
JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
WHERE 1
AND tr.`payment_status`='lunas'
GROUP BY ma.`no_anggota`,tr.`order_id`;

############# Query Asset Product
SELECT  mb.`kode_barang`,mb.`nama_barang`,mb.`harga_beli`,mb.`harga_jual`,
	SUM(sb.`qty`) AS qty,
	SUM(sb.`qty`)*mb.`harga_jual` AS 'asset_by_harga_jual',
	SUM(sb.`qty`)*mb.`harga_beli` AS 'asset_by_harga_beli'
FROM stok_barang sb 
JOIN master_barang mb ON mb.`kode_barang`=sb.`kode_barang`
WHERE 1
AND mb.`status`=1
AND mb.`hapus`=0
GROUP BY sb.`kode_barang`
;
