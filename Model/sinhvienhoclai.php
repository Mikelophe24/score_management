<?php 

require_once 'Connect/connect.php';
class SinhvienHoclai extends Database_ql_diem
{

	public  static function  ADD($text_masv,$text_mamon,$text_trangthai)
	{
		$sql = "INSERT INTO sinhvienhoclai(ma_sv, ma_mon, trangthai) VALUES ('$text_masv','$text_mamon','$text_trangthai')";
		return parent::Execute($sql);
	}
	public static function  Edit($text_masv,$text_mamon,$text_trangthai)
	{
		$sql = "UPDATE sinhvienhoclai SET trangthai='$text_trangthai' WHERE sinhvienhoclai.ma_sv = '$text_masv' AND sinhvienhoclai.ma_mon='$text_mamon'";
		return parent::Execute($sql);
	}
	public static function  Delete($text_masv,$text_mamon)
	{
		$sql = "DELETE FROM sinhvienhoclai WHERE sinhvienhoclai.ma_sv = '$text_masv' AND sinhvienhoclai.ma_mon='$text_mamon'";
		return parent::Execute($sql);
	}

	public static function  List()
	{
		$sql = "SELECT * FROM sinhvienhoclai a, sinhvien b, monhocphan c WHERE a.ma_sv = b.ma_sv AND a.ma_mon = c.ma_mon";
		return parent::Getdata($sql);
	}
}

 ?>