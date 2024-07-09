<?php 

require_once 'Connect/connect.php';
class SinhvienThilai extends Database_ql_diem
{

	public  static function  ADD($text_masv,$text_mamon,$text_trangthai)
	{
		$sql = "INSERT INTO sinhvienthilai(ma_sv, ma_mon, trangthai) VALUES ('$text_masv','$text_mamon','$text_trangthai')";
		return parent::Execute($sql);
	}
	public static function  Edit($text_masv,$text_mamon,$text_trangthai)
	{
		$sql = "UPDATE sinhvienthilai SET trangthai='$text_trangthai' WHERE sinhvienthilai.ma_sv = '$text_masv' AND sinhvienthilai.ma_mon='$text_mamon'";
		return parent::Execute($sql);
	}
	public static function  Delete($text_masv,$text_mamon)
	{
		$sql = "DELETE FROM sinhvienthilai WHERE sinhvienthilai.ma_sv = '$text_masv' AND sinhvienthilai.ma_mon='$text_mamon'";
		return parent::Execute($sql);
	}

	public static function  List()
	{
		$sql = "SELECT * FROM sinhvienthilai a, sinhvien b, monhocphan c WHERE a.ma_sv = b.ma_sv AND a.ma_mon = c.ma_mon";
		return parent::Getdata($sql);
	}
}

 ?>