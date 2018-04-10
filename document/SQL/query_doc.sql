SELECT mb.`kode_barang`,mb.`nama_barang`,SUM(trd.`sub_total`)'penjualan',sub.nama_barang,sub.pembelian,
	(SUM(trd.`sub_total`))-sub.pembelian AS 'keuntunganBy product'
FROM transaksi tr
JOIN `transaksi_detail` trd ON tr.`order_id`=trd.`order_id`
JOIN master_barang mb ON trd.`order_master_id`=mb.`kode_barang`
LEFT JOIN(
	SELECT mbb.nama_barang,mbb.`kode_barang`,SUM(pd.`sub_total`) AS 'pembelian'
		FROM pembelian pe
		JOIN pembelian_detail pd ON pe.`order_id`=pd.`order_id`
		JOIN master_barang mbb ON mbb.`kode_barang`=pd.`order_master_id`
	WHERE 1
	AND pe.`payment_status`='LUNAS'
	GROUP BY mbb.`kode_barang`
)sub ON sub.kode_barang=mb.`kode_barang`
WHERE 1
AND tr.`payment_status`='LUNAS'
GROUP BY mb.`kode_barang`;