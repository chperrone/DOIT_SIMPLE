<?php
require_once("socrata.php");
$socrata = new Socrata("http://data.cityofboston.gov/api");

//if(isset($_POST['streetnum'], $_POST['streetname'])) {
$snum = 51;//$_POST['streetnum'];
$sname = "Calumet";//$_POST['streetname'];
//}

$query = "street = '$sname' AND (stno = '$snum' OR (stno <= '$snum' AND sthigh >= '$snum'))";


$params = array("\$where" => $query);

$response = $socrata->get("/resource/8sq6-p7et.json", $params);

$lat;
$lng;

///Year Class
//
class Year {

	public $name;
	public $loInc;

	public function __construct($name, $loInc) {
		$this->name = $name;
		$this->loInc = $loInc;
	}

	public function __toString() {
		return "Year: " . $this->name . $this->listToString();
	}

	public function listToString() {

		$result = '';

		foreach ($this->loInc as $value) {
			 $result = $result . ' ' . $value;
		}

		return $result;
	}

	//add an incident to a particular year's incident list
	public function addInc($inc) {
		$placed = false;

		foreach ($this->loInc as $value) {
			if ($inc->desc === $value->desc) {
				$value->incFreq();
				$placed = true;
			}
		}

		if ($placed === false) {
			array_push($this->loInc, $inc);
		}
	}
}

///Incident Class
//
class Incident {

	public $freq;
	public $desc;
	public $cat;
	public $rat;

	public function __construct($freq, $desc, $cat, $rat) {
		$this->freq = $freq;
		$this->desc = $desc;
		$this->cat  = $cat;
		$this->rat  = $rat;
	}

	public function __toString() {
		return $this->freq . ' ' . $this->desc . ' ' . $this->cat;
	}

	//increase the frequency by 1
	public function incFreq() {
		$this->freq = $this->freq + 1;
	}
}


///return a new Incident with the correct labels
//
function relabel($string) {
	$con = mysqli_connect("localhost", "root", "root", "DOIT");

	$query = "SELECT * FROM violations WHERE
			  short= '$string'";

	if ( $stmt = mysqli_query( $con, $query ) ) {

			$row = mysqli_fetch_array( $stmt );

			$proper = $row['proper'];
			$cat = $row['category'];
			$rat = $row['rating'];

			if (is_null($proper) ||
				is_null($cat) ||
				is_null($rat)) {
				return new Incident(1, "Other", "Other", 0);
			}
			else { return new Incident(1, $proper, $cat, $rat); }
	}

	mysqli_close($con);
}

function parseJson($response) {
	$result['list'] = array();

	$result['address'] = getAddress($response[0]);

	foreach ($response as $item) {
		$year = substr($item['status_dttm'], 0, 4);
		$placed = false;

		foreach ($result['list'] as $a) {
			if ($a->name === $year) {
				$a->addInc(relabel($item['description']));
				$placed = true;
			}
		}

		if (!$placed) {
			array_push($result['list'], new Year($year, array(relabel($item['description']))));
		}
	}
	echo json_encode($result);
}

function getAddress($cell) {
	$lat = $cell['latitude'];
	$lng = $cell['longitude'];

	//fire($lat, $lng);


	if (isset($cell['sthigh'])) {
		return $cell['stno'].'-'.$cell['sthigh'].' '.$cell['street'].' '.strtolower($cell['suffix'])
		.' '.$cell['city'].' '.$cell['zip'];
	}
		return $cell['stno'].' '.$cell['street'].' '.strtolower($cell['suffix'])
		.' '.$cell['city'].' '.$cell['zip'];
}

function tester() {
	$result = array();
	array_push($result, new Year(2013, array()));

	echo "Compiled!";

	echo '</br></br>';

	$inc0 = new Incident(2, 'trash', 'cleanliness');
	$inc1 = new Incident(3, 'hole', 'cleanliness');
	echo $inc0->__toString();
	$inc0->incFreq();
	echo $inc0->__toString();

	echo '</br>';

	$array = array();
	array_push($array, $inc0);
	array_push($array, $inc1);

	$year0 = new Year(2014, $array);
	echo $year0->__toString();
	$inc2 = new Incident(4, 'holes', 'man');
	$year0->addInc($inc2);
	echo '</br>';
	echo $year0->__toString();
	echo '</br>';
}

parseJson($response);

function fire($lat, $lng) {
	echo $lat;
	echo $lng;

	$socrata2 = new Socrata("http://data.cityofboston.gov/api");
	
	$query2 = "within_circle(location, $lat, $longitude, $range)";
			   //(((('$lat' - latitude) < .0025) AND (('$lat' - latitude) >= 0)) OR
			   //(((latitude - '$lat') < .0025) AND ((latitude - '$lat') >= 0)));
			   

	$params2 = array("\$where" => $query2);
	$response2 = $socrata2->get("/resource/awu8-dc52.json", $params2);

	echo json_encode($response2);

}

?>