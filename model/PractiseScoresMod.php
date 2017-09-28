<?php

/**
 * Created by PhpStorm.
 * User: tanphat
 * Date: 06/08/2017
 * Time: 12:23
 */

class PractiseScoresMod {
	private $connSQL;

	public function __construct() {
		$this->connSQL = new ConnectToSQL();
	}

	/**
	 * Lấy danh sách điểm của 1 tài khoản
	 * @param $idAccount
	 * @return array - danh sách điểm dưới dạng các mảng của tài khoản đó
	 */
	public function getListAllScores($idAccount){
		$sql = "select * from practisescores where Account_idAccount = '$idAccount'";
		$this->connSQL->Connect();
		$result = $this->connSQL->conn->query($sql);
		$listRow = array();
		if ($result->num_rows > 0){
			while ($row = $result->fetch_assoc())
				$listRow[] = $row;
		}
		$this->connSQL->Stop();
		return $listRow;
	}

	/**
	 * Lấy danh sách điểm của tài khoản trong năm học
	 * @param $idAccount
	 * @param $year
	 * @return array - danh sách các mảng chứa điểm của tài khoản đó
	 */
	public function getListAllScoresByYear($idAccount, $year){
		$sql = "select * from practisescores where Account_idAccount = '$idAccount' and years = '$year'";
		$this->connSQL->Connect();
		$result = $this->connSQL->conn->query($sql);
		$listRow = array();
		if ($result->num_rows > 0){
			while ($row = $result->fetch_assoc())
				$listRow[] = $row;
		}
		$this->connSQL->Stop();
		return $listRow;
	}

    public function getListYears(){
        $sql = "SELECT DISTINCT semester,years,beginDate,endDate FROM PractiseScores ";
        $this->connSQL->Connect();
        $result = $this->connSQL->conn->query($sql);
        $listRow = array();
        $k=0;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $practices = new PractiseScoresObj();
                $practices->setSemester($row['semester']);
                $practices->setYears($row['years']);
                $practices->setBeginDate($row['beginDate']);
                $practices->setEndDate($row['endDate']);
                $listRow[$k]= $practices;
                $k++;
            }

        }
        $this->connSQL->Stop();
        return $listRow;
    }

	/**
	 * Lấy điểm số của của năm học, học kỳ chỉ định của 1 account
	 * @param $pcObj - Chưa lưu điểm trong object này
	 * @return PractiseScoresObj
	 */
	public function getPractiseScores($pcObj){
		$sql = "select * from practisescores 
				where Account_idAccount = '{$pcObj->getAccount_IdAccount()}' 
				and semester = '{$pcObj->getSemester()}' 
				and years = '{$pcObj->getYears()}'";
		$this->connSQL->Connect();
		$result = $this->connSQL->conn->query($sql);
		if ($result->num_rows > 0){
			$pcRow = $result->fetch_assoc();
			$pcObj->setScores($pcRow['scores']);
		}
		$this->connSQL->Stop();
		return $pcObj;
	}

	/**
	 * Thêm điểm cho account trong năm học, học kỳ đó
	 * @param $pcObj - PractiseScoresObj
	 * @return bool
	 */
	public function addPractiseScores($pcObj){
		$sql = "insert into practisescores 
				values(
					'{$pcObj->getScores()}', 
					'{$pcObj->getSemester()}',
					'{$pcObj->getYears()}',
					'{$pcObj->getAccount_IdAccount()}',
					'{$pcObj->getBeginDate()}',
					'{$pcObj->getEndDate()}'
				)";
		$this->connSQL->Connect();
		$result = $this->connSQL->conn->query($sql);
		$this->connSQL->Stop();
		return $result;
	}

	/**
	 * Xóa điểm của tài khoản vào năm học, học kỳ được chỉ định
	 * @param $pcObj - PractiseScoresObj
	 * @return bool
	 */
	public function deletePractiseScores($pcObj){
		$sql = "delete from practisescores 
				where Account_idAccount = '{$pcObj->getAccount_IdAccount()}'
				and semester = '{$pcObj->getSemester()}'
				and years = '{$pcObj->getYears()}'";
		$this->connSQL->Connect();
		$result = $this->connSQL->conn->query($sql);
		$this->connSQL->Stop();
		return $result;
	}

	/**
	 * Cập nhật lại điểm cho tài khoản vào năm học học kỳ chỉ định
	 * @param $pcObj - PractiseScoresObj
	 * @return bool
	 */
	public function updatePractiseScores($pcObj){
		$sql = "update practisescores set scores = '{$pcObj->getScores()}',beginDate = '{$pcObj->getbeginDate()}',endDate = '{$pcObj->getEndDate()}'
				where Account_idAccount = '{$pcObj->getAccount_IdAccount()}'
				and semester = '{$pcObj->getSemester()}'
				and years = '{$pcObj->getYears()}'";
		$this->connSQL->Connect();
		$result = $this->connSQL->conn->query($sql);
		$this->connSQL->Stop();
		return $result;
	}
}