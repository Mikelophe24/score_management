<?php 
session_start();
require_once 'Model/lop.php';
require_once 'Model/sinhvien.php';
require_once 'Model/Diemchitiep.php';
require_once 'Model/diemhocpham.php';
require_once 'Model/monhocphan.php';
require_once 'Model/sinhvienhoclai.php';
require_once 'Model/sinhvienthilai.php';
require_once 'Model/sinhvienhocbong.php';
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}
else
{
	$action = NULL;
}
switch ($action) {
	case 'List_Diem':
		if (isset($_GET['maSV'])) {
			$maSV = $_GET['maSV'];

			$dHP = TongDiemChitiet::DiemHP($maSV);
			$sv = Sinhvien::GetId($maSV);
			$ttDiem = TongDiemChitiet::TDiem($maSV);
		}
		require_once 'View/Diem/list_diem.php';
		break;
		case 'Add_Diem_HP':
			$list_sv = Sinhvien::List();
			$list_hp = MonHP::List();
			if (isset($_POST['themDiem'])) {
				$maSV = isset($_POST['sellist1']) ? $_POST['sellist1'] : '';
				$maM = isset($_POST['sellist2']) ? $_POST['sellist2'] : '';
				$lanthi = isset($_POST['sellist3']) ? $_POST['sellist3'] : 0;
				$txt_diemGK = isset($_POST['txt_diemGK']) ? $_POST['txt_diemGK'] : '';
				$txt_diemTHK = isset($_POST['txt_diemTHK']) ? $_POST['txt_diemTHK'] : '';
				if ($maSV == '' || $maM == '' || $txt_diemGK == '' || $txt_diemTHK == '' || $lanthi == 0) {
					$thatbai = "Vui lòng nhập đủ thông tin";
				}
				$sqlCheckUnique = 'select * from diemhocphan where ma_sv="' . $maSV . '" and ma_mon="' . $maM . '" and lanthi = ' . $lanthi;
				$dataCheckUnique = DiemMHP::Getdata($sqlCheckUnique);
				if (is_array($dataCheckUnique) && count($dataCheckUnique) > 1) {
					$thatbai = "Điểm của sinh viên này đã được nhập trước đó";
				}
				if ($lanthi == 2) {
					$firstAttemptScore = DiemMHP::GetFirstAttemptScore($maSV, $maM);
					if (count($firstAttemptScore) > 0 && $firstAttemptScore[0]['diem_thi_hp'] >= 4) {
						$thatbai = "Không thể nhập điểm lần 2 vì điểm học phần lần 1 đang >= 4";
					}
				}
				if (!isset($thatbai) && DiemMHP::ADD($maSV, $maM, $txt_diemGK, $txt_diemTHK, $lanthi)) {
					$thanhcong = "Thêm điểm thành công";
				} else {
					if (!isset($thatbai)) {
						$thatbai = "Thêm điểm thất bại";
					}
				}
			}
			require_once 'View/Diem/add_diem.php';
			break;
			case 'Edit_Diem_HP':
				if (isset($_GET['maMon']) && isset($_GET['lanthi'])) {
					$text_masv = $_GET['maSV'];
					$text_mamon = $_GET['maMon'];
					$lanthi = $_GET['lanthi'];
					$demsolanthi = DiemMHP::DemSoLanThi($text_masv, $text_mamon);
					var_dump($demsolanthi );
					$list_diem_lop_sinhvien = DiemMHP::D_M_SV($text_masv, $text_mamon, $lanthi);
			
					if ($demsolanthi  >=2 && $lanthi == 1) {
						$thatbai = "Bạn không được phép sửa điểm ở phần thi thứ nhất vì đã có điểm lần sau rồi.";
					} elseif (isset($_POST['suaDiem'])) {
						$txt_diemGK = $_POST['txt_diemGK'];
						$txt_diemTHK = $_POST['txt_diemTHK'];
			
						if (DiemMHP::Edit($text_masv, $text_mamon, $txt_diemGK, $txt_diemTHK, $lanthi)) {
							header('location:index.php?controllers=diem&action=QL_Diem');
						} else {
							$thatbai = "Sửa điểm thất bại";
						}
					}
				}
				require_once 'View/Diem/edit_diem.php';
				break;


				error_reporting(E_ALL);
		ini_set('display_errors', 1);

		case 'Delete_Diem_HP':
			if (isset($_GET['maSV']) && isset($_GET['maMon']) && isset($_GET['lanthi'])) {
				$text_masv = $_GET['maSV'];
				$text_mamon = $_GET['maMon'];
				$lanthi = $_GET['lanthi'];
		
				if (DiemMHP::Delete($text_masv, $text_mamon, $lanthi)) {
					header('location:index.php?controllers=diem&action=QL_Diem');
				} else {
					echo "Xóa thất bại";
				}
			}
			break;
	case 'QL_Diem':
		$list_lop = Lop::List();
		if (isset($_GET['maLop'])) {
			$maLop = $_GET['maLop'];
			$list_sv = DiemMHP::Lop_Sinhvien($maLop);
		}
		if (isset($_GET['maSV'])) {
			$text_masv = $_GET['maSV'];
			$dHP = DiemMHP::List($text_masv);
		}

		require_once 'View/Diem/xl_diem.php';
		break;
	case 'Tonghopdiem':
		$list_lop = Lop::List();
		$list_lop_sinhvien = Sinhvien::List();
		if (isset($_POST["Hienthi"])) {
			$txt_malop = $_POST['txt_malop'];
			if($txt_malop != ''){
				$list_lop_sinhvien = Lop::Lop_Sinhvien($txt_malop);
			}
		}
		elseif (isset($_POST["xem"])) {	
			if(isset($_POST['txt_malop']) && $_POST['txt_malop'] != ''){
				$list_lop_sinhvien = Lop::Lop_Sinhvien($_POST['txt_malop']);
			}
			if(isset($_POST['txt_masinhvien'])){
				$txt_masinhvien = $_POST['txt_masinhvien'];

				$sv = Sinhvien::GetId($txt_masinhvien);
				$ttDiem = TongDiemChitiet::TDiem($txt_masinhvien);
				
			}
		}
		$dataPost = $_POST;
		require_once 'View/Tonghopdiemsinhvien.php';
		break;
	case 'Thong_ke':
		$sv = Sinhvien::List();
		$dem = 0;
		$ma_sv_l = array();
	
		foreach ($sv as $value) {
			$ma_sv_l[] = $value['ma_sv'];
			$dem++;
		}
	
		for($i = 0; $i < $dem; $i++) {
			$sv_tc_sv = TongDiemChitiet::TDiem($ma_sv_l[$i]);
	
			$TongSTC = 0;
			$TongHDS = 0;
	
			if (is_array($sv_tc_sv)) {
				foreach ($sv_tc_sv as $value) {
					$diemHP = round(($value['diem_giua_ky'] * 0.3) + ($value['diem_thi_hp'] * 0.7), 1);
					$diemchu = TongDiemChitiet::DC($diemHP);
					$diemheso = TongDiemChitiet::HDS($diemHP);
	
					$TinhDHS = $value['sotinchi'] * $diemheso;
	
					$TongSTC += $value['sotinchi'];
					$TongHDS += $TinhDHS;
				}
			}
	
			if ($TongSTC > 0) {
				$tbtk = round($TongHDS / $TongSTC, 2);
				$xltk = TongDiemChitiet::XL_TK($TongHDS / $TongSTC);
			} else {
				$tbtk = 0;
				$xltk = 'N/A';
			}
	
			$TSTC = $TongSTC;
			$TB_Toankhoa = $tbtk;
			$XL_Toankhoa = $xltk;
	
			// Determine scholarship status
			if ($TB_Toankhoa >= 3.6) {
				$hoc_bong = 'Học bổng xuất sắc';
			} elseif ($TB_Toankhoa >= 3.2) {
				$hoc_bong = 'Học bổng loại giỏi';
			} else {
				$hoc_bong = 'Không đạt';
			}
	
			$sv[$i]['STC'] = $TSTC;
			$sv[$i]['TB_Toankhoa'] = $TB_Toankhoa;
			$sv[$i]['XL_Toankhoa'] = $XL_Toankhoa;
			$sv[$i]['hoc_bong'] = $hoc_bong;
		}
	
		require_once 'View/thongke.php';
		break;
	case 'Thi_lai':
		$get = $_GET;
		$ma_sv = isset($get['ma_sv'])?$get['ma_sv']:'';
		$ma_mon = isset($get['ma_mon'])?$get['ma_mon']:'';
		if($ma_sv == '' || $ma_mon == ''){
			echo json_encode(['code'=>100,'message'=>'Yêu cầu không hợp lệ!']);die();
		}
		$sqlCheckUnique = 'select * from sinhvienthilai where ma_sv="'.$ma_sv.'" and ma_mon="'.$ma_mon.'" and trangthai = 0';
		$dataCheckUnique = SinhvienThilai::Getdata($sqlCheckUnique);
		if(is_array($dataCheckUnique) && count($dataCheckUnique) > 0){
			echo json_encode(['code'=>100,'message'=>'Yêu cầu của bạn đã được tạo trước đó!']);die();
		}
		SinhvienThilai::ADD($ma_sv,$ma_mon,0);
		echo json_encode(['code'=>200,'message'=>'Tạo yêu cầu thành công!']);die();
		break;
	case 'Hoc_lai':
		$get = $_GET;
		$ma_sv = isset($get['ma_sv'])?$get['ma_sv']:'';
		$ma_mon = isset($get['ma_mon'])?$get['ma_mon']:'';
		if($ma_sv == '' || $ma_mon == ''){
			echo json_encode(['code'=>100,'message'=>'Yêu cầu không hợp lệ!']);die();
		}
		$sqlCheckUnique = 'select * from sinhvienhoclai where ma_sv="'.$ma_sv.'" and ma_mon="'.$ma_mon.'" and trangthai = 0';
		$dataCheckUnique = SinhvienHoclai::Getdata($sqlCheckUnique);
		if(is_array($dataCheckUnique) && count($dataCheckUnique) > 0){
			echo json_encode(['code'=>100,'message'=>'Yêu cầu của bạn đã được tạo trước đó!']);die();
		}
		SinhvienHoclai::ADD($ma_sv,$ma_mon,0);
		echo json_encode(['code'=>200,'message'=>'Tạo yêu cầu thành công!']);die();
		break;
	case 'Hoc_bong':
		$get = $_GET;
		$ma_sv = isset($get['ma_sv'])?$get['ma_sv']:'';
		$ma_mon = isset($get['ma_mon'])?$get['ma_mon']:'';
		if($ma_sv == ''){
			echo json_encode(['code'=>100,'message'=>'Yêu cầu không hợp lệ!']);die();
		}
		$sqlCheckUnique = 'select * from sinhvienhocbong where ma_sv="'.$ma_sv.'" and trangthai = 0';
		$dataCheckUnique = SinhvienHocbong::Getdata($sqlCheckUnique);
		if(is_array($dataCheckUnique) && count($dataCheckUnique) > 0){
			echo json_encode(['code'=>100,'message'=>'Yêu cầu của bạn đã được tạo trước đó!']);die();
		}
		SinhvienHocbong::ADD($ma_sv,0);
		echo json_encode(['code'=>200,'message'=>'Tạo yêu cầu thành công!']);die();
		break;
	default:
		echo "Trang không tồn tại";
		break;
}


 ?>