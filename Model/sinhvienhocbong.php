<?php 

require_once 'Connect/connect.php';
class SinhvienHocbong extends Database_ql_diem
{

	public  static function  ADD($text_masv,$text_trangthai)
	{
		$sql = "INSERT INTO sinhvienhocbong(ma_sv, trangthai) VALUES ('$text_masv','$text_trangthai')";
		return parent::Execute($sql);
	}
	public static function  Edit($text_masv,$text_mamon,$text_trangthai)
	{
		$sql = "UPDATE sinhvienhocbong SET trangthai='$text_trangthai' WHERE sinhvienhocbong.ma_sv = '$text_masv'";
		return parent::Execute($sql);
	}
	public static function  Delete($text_masv)
	{
		$sql = "DELETE FROM sinhvienhocbong WHERE sinhvienhocbong.ma_sv = '$text_masv'";
		return parent::Execute($sql);
	}

	public static function  List()
	{
		$sql = "SELECT * FROM sinhvienhocbong a, sinhvien b WHERE a.ma_sv = b.ma_sv";
		return parent::Getdata($sql);
	}
}

 ?>