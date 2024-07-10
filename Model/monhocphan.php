<?php 

require_once 'Connect/connect.php';
class MonHP extends Database_ql_diem
{
	public static function ADD($txt_maHocphan, $txt_tenHocphan, $txt_stc, $txt_mahocky) {
		// Check if the ma_hocphan already exists
		$checkSql = "SELECT COUNT(*) FROM monhocphan WHERE ma_mon = '$txt_maHocphan'";
		$result = parent::Execute($checkSql);
	
		// Assuming Execute returns a result set, you need to fetch the result
		$row = mysqli_fetch_row($result);
		if ($row[0] > 0) {
			// Duplicate found
			return false;
		} else {
			// No duplicate, proceed with the insertion
			$sql = "INSERT INTO monhocphan(ma_mon, ten_mon, sotinchi, ma_hk) VALUES ('$txt_maHocphan','$txt_tenHocphan','$txt_stc','$txt_mahocky')";
			return parent::Execute($sql);
		}
	}

	public static function Execute($sql) {
		$conn = // your database connection
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			die('Query failed: ' . mysqli_error($conn));
		}
		return $result;
	}
	public static function id_DHP($txt_maHocphan)
	{
		$sql = "SELECT * FROM monhocphan WHERE monhocphan.ma_mon='$txt_maHocphan'";
		return parent::Getdata($sql);
	}
	public static function Edit($txt_maHocphan,$txt_tenHocphan,$txt_stc,$txt_mahocky,$id_ma_monHp)
	{
		$sql = "UPDATE monhocphan SET ma_mon='$txt_maHocphan',ten_mon='$txt_tenHocphan',sotinchi='$txt_stc',ma_hk='$txt_mahocky' WHERE monhocphan.ma_mon='$id_ma_monHp'";
		return parent::Execute($sql);
	}
	public static function Delete($txt_maHocphan)
	{
		$sql = "DELETE FROM monhocphan WHERE monhocphan.ma_mon='$txt_maHocphan'";
		return parent::Execute($sql);
	}
	public static function List()
	{
		$sql = "SELECT * FROM monhocphan";
		return parent::Getdata($sql);
	}
	public static function Search($keyword)
	{
		$sql = "SELECT * from monhocphan WHERE ma_mon LIKE '%$keyword%' OR ten_mon LIKE '%$keyword%';";
		$data =  parent::Getdata($sql);
		if($data == 0){
			$data  = [];
		}
		return $data ;
	}
}

 ?>