SELECT *
FROM transaksi tr
JOIN transaksi_detail td
	ON tr.`order_id` = td.`order_id`
JOIN master_barang mb
	ON td.`order_master_id` = mb.`kode_barang`
LEFT JOIN master_anggota ma
	ON ma.`no_anggota` = tr.`kode_customer`
WHERE 1
AND YEAR(order_timestamp) = 2017
ORDER BY tr.`order_id` DESC LIMIT 100000000000
WHERE 1
AND ;

SELECT *
FROM transaksi tr
JOIN transaksi_detail trd 
	ON tr.`order_id` = trd.`order_id`
WHERE 1
AND tr.`order_id` = 16876;

SELECT *
FROM log_transaksi_penjualan a
WHERE 1
AND a.`order_id` = 41898


;
2017 = 50725
2018 = 2857
2016 = 36742;

