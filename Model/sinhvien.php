<?php 

require_once 'Connect/connect.php';
class Sinhvien extends Database_ql_diem
{

	public static function ADD($text_masv, $text_tensv, $text_ngaysinh, $text_gioitinh, $text_dantoc, $text_noisinh, $text_malop)
    {
        // Check if ma_sv already exists
        $check_sql = "SELECT COUNT(*) FROM sinhvien WHERE ma_sv = '$text_masv'";
        $result = parent::Execute($check_sql);
        $count = mysqli_fetch_array($result)[0];

        if ($count > 0) {
            // ma_sv already exists, return an error message
            return "Mã sinh viên đã tồn tại.";
        } else {
            // ma_sv does not exist, proceed with the insertion
            $sql = "INSERT INTO sinhvien(ma_sv, hoten_sv, ngay_sinh, gioi_tinh, dan_toc, noi_sinh, ma_lop) VALUES ('$text_masv', '$text_tensv', '$text_ngaysinh', '$text_gioitinh', '$text_dantoc', '$text_noisinh', '$text_malop')";
            return parent::Execute($sql);
        }


    }
	public static function GetId($id)
	{
		$sql = "SELECT * FROM sinhvien WHERE sinhvien.ma_sv = '$id'";
		return parent::Execute($sql);
	}
	public static function Edit($text_masv,$text_tensv,$text_ngaysinh,$text_gioitinh,$text_dantoc,$text_noisinh,$text_malop,$id)
	{
		$sql = "UPDATE sinhvien SET ma_sv='$text_masv',hoten_sv='$text_tensv',ngay_sinh='$text_ngaysinh',gioi_tinh='$text_gioitinh',dan_toc='$text_dantoc',noi_sinh='$text_noisinh',ma_lop='$text_malop' WHERE ma_sv='$text_masv'";
		return parent::Execute($sql);
	}
	public static function Delete($text_masv)
	{
		$sql = "DELETE FROM sinhvien WHERE sinhvien.ma_sv = '$text_masv'";
		return parent::Execute($sql);
	}
	public static function List()
		{
			$sql = "SELECT * FROM sinhvien AS s INNER JOIN lop AS l ON s.ma_lop = l.ma_lop ";
			return parent::Getdata($sql);
		}
	public static function Seach($txt_Tiemkiem)
	{
		$sql = "SELECT * FROM sinhvien, lop WHERE sinhvien.ma_lop = lop.ma_lop AND sinhvien.hoten_sv LIKE '%$txt_Tiemkiem%'";
		return parent::Getdata($sql);
	}
}

 ?>