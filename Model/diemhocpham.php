<?php 

require_once 'Connect/connect.php';

class DiemMHP extends Database_ql_diem
{
	public static function ADD($text_masv, $text_mamon, $text_diemgk, $text_diemthk, $lanthi)
	{
		$sql = "INSERT INTO diemhocphan(ma_sv, ma_mon, diem_giua_ky, diem_thi_hp, lanthi) VALUES ('$text_masv', '$text_mamon', '$text_diemgk', '$text_diemthk', '$lanthi')";
		return parent::Execute($sql);
	}

	public static function GetFirstAttemptScore($ma_sv, $ma_mon)
	{
		$sql = "SELECT diem_thi_hp FROM diemhocphan WHERE ma_sv = '$ma_sv' AND ma_mon = '$ma_mon' AND lanthi = 1";
		return parent::Getdata($sql);
	}
	public static function Edit($text_masv, $text_mamon, $text_diemgk, $text_diemthk, $lanthi)
	{
		if ($lanthi == 1) {
			return false; // Không cho phép sửa điểm ở phần thi thứ nhất
		}
	
		$sql = "UPDATE diemhocphan SET diem_giua_ky='$text_diemgk', diem_thi_hp='$text_diemthk' WHERE ma_sv='$text_masv' AND ma_mon='$text_mamon' AND lanthi=$lanthi";
		return parent::Execute($sql);
	}
		public static function Delete($text_masv, $text_mamon, $lanthi)
	{
		$sql = "DELETE FROM diemhocphan WHERE ma_sv = '$text_masv' AND ma_mon = '$text_mamon' AND lanthi = $lanthi";
		return parent::Execute($sql);
	}
	// lấy tất cả môn cho từng sinh viên 
	public static function  List($text_masv)
	{
		$sql = "SELECT * FROM sinhvien s, lop l, monhocphan m, diemhocphan d, hocky h 
            WHERE s.ma_sv = d.ma_sv 
            AND s.ma_lop = l.ma_lop 
            AND m.ma_mon = d.ma_mon 
            AND m.ma_hk = h.ma_hk 
            AND s.ma_sv = '$text_masv'";

		$result = parent::Getdata($sql);
		if ($result == 0){
			$result = [];
		}
    return $result;
	}
	// lấy ds sinh viên trong 1 lớp
	public static function  Lop_Sinhvien($txt_malop)
	{
		$sql = "SELECT * FROM sinhvien,lop WHERE sinhvien.ma_lop = lop.ma_lop AND sinhvien.ma_lop='$txt_malop'";
	  $result = parent::Getdata($sql);
		if ($result == 0){
			$result = [];
		}
    return $result;
	}
	// lấy từng môn của từng sinh viên
	public static function  D_M_SV($text_masv,$text_mamon)
	{
		$sql = "SELECT * FROM monhocphan m, sinhvien s, diemhocphan d WHERE m.ma_mon = d.ma_mon AND d.ma_sv = s.ma_sv AND d.ma_mon = '$text_mamon' AND d.ma_sv = '$text_masv'";
		return parent::Getdata($sql);
	}
}

 ?>