<?php 
require_once 'Connect/connect.php';
class Hocky extends Database_ql_diem
{
    public static function ADD($text_mahoky, $text_tenhocky)
    {
        // Check if ma_hk already exists
        $checkSql = "SELECT COUNT(*) FROM hocky WHERE ma_hk = '$text_mahoky'";
        $result = parent::Execute($checkSql);

        // Assuming Execute returns a result set, fetch the count
        $row = mysqli_fetch_row($result);
        if ($row[0] > 0) {
            // Duplicate found
            return false;
        } else {
            // No duplicate, proceed with the insertion
            $sql = "INSERT INTO hocky(ma_hk, ten_hk) VALUES ('$text_mahoky','$text_tenhocky')";
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
	
	public static function List_id($id_text_mahocky)
	{
		$sql = "SELECT * FROM hocky WHERE hocky.ma_hk = '$id_text_mahocky'";
		return parent::Getdata($sql);
	}
	public static function Edit($text_mahoky,$text_tenhocky,$id_text_mahocky)
	{
		$sql = "UPDATE hocky SET ma_hk='$text_mahoky',ten_hk='$text_tenhocky' WHERE ma_hk='$id_text_mahocky'";
		return parent::Execute($sql);
	}
	public static function Delete($id_text_mahocky)
	{
		$sql = "DELETE FROM hocky WHERE hocky.ma_hk = '$id_text_mahocky'";
		return parent::Execute($sql);
	}
	public static function List()
	{
		$sql = "SELECT * FROM hocky";
		return parent::Getdata($sql);
	}
	public static function Search($keyword)
	{
		$sql = "SELECT * from hocky WHERE ma_hk LIKE '%$keyword%' OR ten_hk LIKE '%$keyword%';";
		$hks =  parent::Getdata($sql);
		if($hks == 0){
			$hks  = [];
		}
		return $hks ;
	}
}

 ?>