SELECT ma.`no_anggota`,ma.`nik`,md.`nama_departemen`,ma.`nama`,
	IFNULL(sub_hutang_pinjaman.hutang,0) AS 'pinjaman_koperasi',
	IFNULL(sub_hutang_penjualan.hutang,0) AS 'pinjaman_belanja',
	IFNULL(sub_iuran.simpanan,0) AS 'iuran',
	IFNULL(sub_hutang_pinjaman.hutang,0)+IFNULL(sub_hutang_penjualan.hutang,0)+IFNULL(sub_iuran.simpanan,0) AS 'total' 
FROM master_anggota ma
JOIN master_departemen md ON md.`kode_departemen`=ma.`departemen`
LEFT JOIN
(
	SELECT ma.`nik`,ma.`nama`,SUM(a.`cicilan_perbulan`) AS hutang ,a.* 
	FROM cicilan a
	JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
	WHERE 1
	AND DATE_FORMAT(a.`jatuh_tempo`,'%Y-%m')='2016-02'
	AND a.`status`='belum' 
	AND a.`keterangan`='transaksi_pinjaman'
	AND update_timestamp IS NULL
	GROUP BY a.`no_anggota`
) sub_hutang_pinjaman
	ON sub_hutang_pinjaman.no_anggota=ma.`no_anggota`
LEFT JOIN
(
	SELECT ma.`nik`,ma.`nama`,SUM(a.`cicilan_perbulan`) AS hutang ,a.* 
	FROM cicilan a
	JOIN master_anggota ma ON ma.`no_anggota`=a.`no_anggota` 
	WHERE 1
	AND DATE_FORMAT(a.`jatuh_tempo`,'%Y-%m')='2016-02'
	AND a.`status`='belum' 
	AND a.`keterangan`='transaksi_penjualan'
	AND update_timestamp IS NULL
	GROUP BY a.`no_anggota`
) sub_hutang_penjualan 
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
AND ma.`hapus`=0
