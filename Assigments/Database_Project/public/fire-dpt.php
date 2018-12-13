<?php
require '../vendor/autoload.php';
require '../generated-conf/config.php';
session_start();
//////////////////////
// Slim Setup
//////////////////////
$settings = ['displayErrorDetails' => true];
$app = new \Slim\App(['settings' => $settings]);
$container = $app->getContainer();
$container['view'] = function($container) {
	$view = new \Slim\Views\Twig('../templates');
	
	$basePath = rtrim(str_ireplace('index.php', '', 
	$container->get('request')->getUri()->getBasePath()), '/');
	$view->addExtension(
	new Slim\Views\TwigExtension($container->get('router'), $basePath));
	
	return $view;
};



//////////////////////
// Helper Methods
//////////////////////

function logged(){
	if($_SESSION['logged'])
		return true;
	else
		return false;
}

//////////////////////
// Routes
//////////////////////
// home page route
$app->get('/', function ($request, $response, $args) {
	$this->view->render($response, 'home.html');
	return $response;
});
$app->get('/home', function ($request, $response, $args) {
	$this->view->render($response, 'login.html');
	return $response;
});
$app->get('/createU', function ($request, $response, $args) {
	$this->view->render($response, 'createUser.html');
	return $response;
});

$app->post('/createUser',function($request,$response,$args){
		
		//echo $username;
		
		$station = $_COOKIE['sid'];
		$username = $request->getParam('username');
		$pass = $request->getParam('password');
		$user = new User();
		$user->setUsername($username);
		$pass = $user->setPasswordHash($pass);
	
		$user->setUserPassword($pass);
		$user->setStationId($station);
		$user->setAdmin(1);
		$user->save();
		header('Location: UserDashboard');

	die();
	
	});
$app->get('/logout', function ($request, $response, $args) {
	$_SESSION['logged'] =false;
	
	header('Location: home');

	die();

});
$app->get('/badLogin', function ($request, $response, $args) {
	$this->view->render($response, 'failedLogin.html');
	return $response;
});

$app->get('/personell', function ($request, $response, $args) {
	$personell = PersonnelQuery::create()->filterByStationId($_COOKIE['sid'])->find();
	//echo $personell;
	 $this->view->render($response, 'personell.html',['personnels'=>$personell]);
	return $response;
});

$app->get('/UserDashboard', function ($request, $response, $args) {

	if($_SESSION['logged']){
		$this->view->render($response, 'dashboard.html');
		echo $_COOKIE['sid'];
	}
});


/////////////////////
//Ajax Handlers
////////////////////

$app->post('/login',function($request,$response,$args){

	$username = $request->getParam('username');
	$pass = $request->getParam('password');
	//echo $user;
	//echo $pass;
	
	 $user = UserQuery::create()->filterByUsername($username)->findOne();
	 //echo $user;
	if($user){

		$valid = $user->login($pass);
		if($valid)
		{
			$hash = $user->getUserPassword();
		echo "yo in";
		$_SESSION['logged'] = true;
		header('Location: stations');
		die();
		//$this->view->render($response, 'dashboard.html');
		}
		else{
			$valid = false;
		$hash="";
		echo "<h1> MOFO CHILL!</h1>";
		header('Location: badLogin');
		die();
		}
		
	}
	else{
		$valid = false;
		$hash="";
		echo "<h1> MOFO CHILL!</h1>";
		header('Location: badLogin');
		die();
	
	}

	
	});
$app->post('/editPersonnel',function($request,$response,$args){
	
	//$this->view->render($response, 'dashboard.html');
	$pid = $_COOKIE['pid'];
	$p = PersonnelQuery::create()->findPk($pid);
	//	$pn->setName($args['name']);
	// 	$pn->save();

	

	$name =  $request->getParam('name');
	$address = $request->getParam('address');
	$height = $request->getParam('height');
	$weight = $request->getParam('weight');
	$phone = $request->getParam('phoneNumber');
	$ssn = $request->getParam('ssn');
	$shift = $request->getParam('inputShift');
	$cert = $request->getParam('inputCert');
	$station = $_COOKIE['sid'];

	$p->setName($name);
	$p->setAddress($address);
	$p->setHeight($height);
	$p->setWeight($weight);
	$p->setPhoneNumber($phone);
	$p->setSsn($ssn);
	$p->setShiftId($shift);
	$p->setCertificationId($cert);
	$p->setStationId($station);;
	$p->save();
	header('Location: personell');

	die();



	
	});
$app->get('/editP',function($request,$response,$args){
	
	//$this->view->render($response, 'login.html');
	$pid = $_COOKIE['pid'];
	$p = PersonnelQuery::create()->filterByPersonnelId($pid)->findOne();
	//echo $p;
	$station = $_COOKIE['sid'];
	echo $station;
	$s = ShiftQuery::create()->filterByStationId($station)->find();
	$cert = CertificationsQuery::create()->find();
	$this->view->render($response, 'editPersonnel.html',['personnel'=>$p,'shifts'=>$s,'certifications'=>$cert]);



	
	});
$app->post('/deletePersonnel',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$p = PersonnelQuery::create()->findPk($pid);
	$p->delete();

	header('Location: personell');

	die();
	
	});
$app->post('/addPersonnel',function($request,$response,$args){

	
		
		$name =  $request->getParam('name');
		$address = $request->getParam('address');
		$height = $request->getParam('height');
		$weight = $request->getParam('weight');
		$phone = $request->getParam('phoneNumber');
		$ssn = $request->getParam('ssn');
		$shift = $request->getParam('inputShift');
		$cert = $request->getParam('inputCert');
		$station = $_COOKIE['sid'];


		$p = new Personnel();
		$p->setName($name);
		$p->setAddress($address);
		$p->setHeight($height);
		$p->setWeight($weight);
		$p->setPhoneNumber($phone);
		$p->setSsn($ssn);
		$p->setShiftId($shift);
		$p->setCertificationId($cert);
		$p->setStationId($station);
		$p->save();
		header('Location: personell');

		die();

	
	});
$app->get('/addP',function($request,$response,$args){
$station = $_COOKIE['sid'];
$s = ShiftQuery::create()->filterByStationId($station)->find();
$cert = CertificationsQuery::create()->find();

$this->view->render($response, 'addPersonnel.html', ['shifts'=>$s, 'certifications'=>$cert]);

	});

$app->get('/viewPersonnel',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$p = PersonnelQuery::create()->filterByPersonnelId($pid)->findOne();

	$e = PersonnelEquipmentQuery::create()->filterByPersonnelId($pid);

	//$c = CertificationsQuery::create()->filterByPersonnelId($pid)->findOne();
	

	$this->view->render($response, 'viewPersonnel.html',['equipments'=>$e,'personnel'=>$p]);

	});

//////////////////////////////////////////////////////////////////
// Equipment Code
//////////////////////////////////


$app->get('/addEquip',function($request,$response,$args){
		$this->view->render($response, 'addEquipment.html');
});

$app->post('/addEquipment',function($request,$response,$args){

	$name =  $request->getParam('name');
		$brand = $request->getParam('brand');
		$type = $request->getParam('type');
		$condition = $request->getParam('condition');
		$serial = $request->getParam('serial');


		$e = new PersonnelEquipment();
		$e->setName($name);
		$e->setBrand($brand);
		$e->setType($type);
		$e->setEquipmentCondition($condition);
		$e->setSerialNumber($serial);
		$e->setPersonnelId($_COOKIE['pid']);

		$e->save();
		header('Location: viewPersonnel');

		die();
});
$app->get('/editEquip',function($request,$response,$args){
	$pid = $_COOKIE['eid'];
	$p = PersonnelEquipmentQuery::create()->filterByPersonnelEquipmentId($pid)->findOne();
	echo $p;
	echo 'y0000';
	$this->view->render($response, 'editEquipment.html',['equipment'=>$p]);

		
});
$app->post('/editEquipment',function($request,$response,$args){


		$name =  $request->getParam('name');
		$brand = $request->getParam('brand');
		$type = $request->getParam('type');
		$condition = $request->getParam('condition');
		$serial = $request->getParam('serial');


	
		$e->setName($name);
		$e->setBrand($brand);
		$e->setType($type);
		$e->setEquipmentCondition($condition);
		$e->setSerialNumber($serial);
		$e->setPersonnelId($_COOKIE['pid']);

		$e->save();
		header('Location: viewPersonnel');

		die();
});


$app->post('/deleteEquipment',function($request,$response,$args){

	$eid = $_COOKIE['eid'];
	$e = PersonnelEquipmentQuery::create()->filterByPersonnelEquipmentId($eid)->findOne();
	$e->delete();

	header('Location: viewPersonnel');

	die();
	
	});

//////////////////////////////////////////////////////////////////////
/// Stations Code
//////////////////////////////////////////////////////////////////////
$app->get('/stations', function ($request, $response, $args) {
	$stations = StationQuery::create()->find();
	//echo $personell;
	 $this->view->render($response, 'stations.html',['stations'=>$stations]);
	return $response;
});
//add station

$app->post('/addStation',function($request,$response,$args){

		$name =  $request->getParam('inputName');
		$address = $request->getParam('inputAddress');
		$jurisdiction = $request->getParam('inputJurisdiction');
		$shiftName = $request->getParam('inputShift');
		

		$s = new Station();
		$s->setStationName($name);
		$s->setAddress($address);
		$s->setJurisdictionId($jurisdiction);
		$s->save();

		$shift = new Shift();
		$shift->setShiftName($shiftName);
		$shift->setStationId($s->getStationId());
		$shift->save();

		
		
		header('Location: stations');

		die();

	
	});
$app->get('/addS',function($request,$response,$args){
	$j = JurisdictionQuery::create()->find();

$this->view->render($response, 'addStation.html',['jurisdictions'=>$j]);

	});

//edit station

$app->post('/editStation',function($request,$response,$args){
	
	//$this->view->render($response, 'dashboard.html');
	$pid = $_COOKIE['pid'];
	$p = StationQuery::create()->findPk($pid);
	//	$pn->setName($args['name']);
	// 	$pn->save();

	

	$name =  $request->getParam('name');
	$address = $request->getParam('address');
	$jurisdiction = $request->getParam('jurisdiction');
	

	$p->setStationName($name);
	$p->setAddress($address);
	$p->setJurisdictionId($jurisdiction);
	
	$p->save();
	header('Location: stations');

	die();



	
	});
$app->get('/editS',function($request,$response,$args){
	
	//$this->view->render($response, 'login.html');
	$pid = $_COOKIE['pid'];
	$p = StationQuery::create()->filterByStationId($pid)->findOne();

	$j = JurisdictionQuery::create()->find();
	$this->view->render($response, 'editStation.html',['station'=>$p,'jurisdictions'=>$j]);



	
	});
//delete station
$app->post('/deleteStation',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$p = StationQuery::create()->findPk($pid);
	$p->delete();

	header('Location: stations');

	die();
	
	});

//details from station

$app->get('/viewStation',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$p = StationQuery::create()->filterByStationId($pid)->findOne();

	$this->view->render($response, 'viewStation.html',['station'=>$p]);

	});


//////////////////////////////////////////////////////////////////
// Shifts Code
//////////////////////////////////

$app->get('/shifts', function ($request, $response, $args) {

	$shifts = ShiftQuery::create()->filterByStationId($_COOKIE['sid'])->find();
	//echo $personell;
	 $this->view->render($response, 'shifts.html',['shifts'=>$shifts]);
	return $response;
});
// add Shift render
$app->get('/addSh',function($request,$response,$args){
	$station = $_COOKIE['sid'];
	$s = ShiftQuery::create()->filterByStationId($station)->find();
	
	$this->view->render($response, 'addShift.html');

	});

// add shift handler
$app->post('/addShift',function($request,$response,$args){

		$name =  $request->getParam('name');
		

		$s = new Shift();
		$s->setShiftName($name);
		$s->setStationId($_COOKIE['sid']);


		$s->save();
		header('Location: shifts');

		die();

	
	});
//edit Shift Render
$app->get('/editSh',function($request,$response,$args){
	$station = $_COOKIE['sid'];
	$pid = $_COOKIE['pid'];
	$s = ShiftQuery::create()->filterByShiftId($pid)->findOne();
	//echo $s;
	
	$this->view->render($response, 'editShift.html',['shift'=>$s]);

	});
//edit shift handler

$app->post('/editShift',function($request,$response,$args){

		$name =  $request->getParam('name');
		

		$pid = $_COOKIE['pid'];
		$s = ShiftQuery::create()->filterByShiftId($pid)->findOne();
		
		$s->setShiftName($name);
		//$s->setStationId($_COOKIE['sid']);


		$s->save();
		header('Location: shifts');

		die();

	
	});

// delete shift handler
$app->post('/deleteShift',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$p = ShiftQuery::create()->findPk($pid);
	$p->delete();

	header('Location: shifts');

	die();
	
	});
//view shift details
$app->get('/viewShifts',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$s = ShiftQuery::create()->filterByShiftId($pid)->findOne();
	$p = PersonnelQuery::create()->filterByShiftId($pid)->find();

	$this->view->render($response, 'viewShifts.html',['shift'=>$s, 'personnels'=>$p]);

	});
////////////////////////////////////////////////////////////////////// Cerifications Code
///////////////////////////////////////////////////////////////////

//certifications render
$app->get('/certifications', function ($request, $response, $args) {

	$c = CertificationsQuery::create()->find();
	//echo $personell;
	 $this->view->render($response, 'certifications.html',['certifications'=>$c]);
	return $response;
});



//edit certifications render
$app->get('/editCer',function($request,$response,$args){
	$station = $_COOKIE['sid'];
	$pid = $_COOKIE['pid'];
	$s = CertificationsQuery::create()->filterByCertificationId($pid)->findOne();
	//echo $s;
	
	$this->view->render($response, 'editCert.html',['certification'=>$s]);

	});
// edit certification code
$app->post('/editCertifications',function($request,$response,$args){

		$name =  $request->getParam('name');
		$num =  $request->getParam('number');
		

		$pid = $_COOKIE['pid'];
		$s = CertificationsQuery::create()->filterByCertificationId($pid)->findOne();
		
		$s->setName($name);
		$s->setCertificationNumber($num);
		//$s->setStationId($_COOKIE['sid']);


		$s->save();
		header('Location: certifications');

		die();

	
	});
// add Certifications render
$app->get('/addCert',function($request,$response,$args){
	
	
	$this->view->render($response, 'addCert.html');

	});

// add shift handler
$app->post('/addCertifications',function($request,$response,$args){

		$name =  $request->getParam('name');
		$num = $request->getParam('number');
		

		$s = new Certifications();
		$s->setName($name);
		$s->setCertificationNumber($num);


		$s->save();
		header('Location: certifications');

		die();

	
	});
// delete Cert handler
$app->post('/deleteCert',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$s = CertificationsQuery::create()->filterByCertificationId($pid)->findOne();
	$s->delete();

	header('Location: certifications');

	die();
	
	});
/// view Certification Personnel
$app->get('/viewCert',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$s = CertificationsQuery::create()->filterByCertificationId($pid)->findOne();
	$p = PersonnelQuery::create()->filterByCertificationId($pid)->find();

	$this->view->render($response, 'viewCert.html',['certification'=>$s, 'personnels'=>$p]);

	});
//////////////////////////////////////////////////////////////////////
/// Vehicle Code
//////////////////////////////////////////////////////////////////////

$app->get('/vehicles', function ($request, $response, $args) {
	$vehicles = VehiclesQuery::create()->filterByStationId($_COOKIE['sid'])->find();
	//echo $personell;
	 $this->view->render($response, 'vehicles.html',['vehicles'=>$vehicles]);
	return $response;
});

//add station

$app->post('/addVehicle',function($request,$response,$args){

	$make =  $request->getParam('inputMake');
	$model = $request->getParam('inputModel');
	$year = $request->getParam('inputYear');
	$vin =  $request->getParam('inputVin');
	$mileage = $request->getParam('inputMileage');
	$type = $request->getParam('inputType');
	$license =  $request->getParam('inputLicense');
	$location = $request->getParam('inputLocation');
	$status = $request->getParam('inputService');
		

	$s = new Vehicles();
	$s->setMake($make);
	$s->setModel($model);
	$s->setYear($year);
	$s->setVin($vin);
	$s->setMileage($mileage);
	$s->setType($type);
	$s->setLicensePlate($license);
	$s->setStationId($location);
	$s->setInService($status);
		
		
		
	$s->save();
	header('Location: vehicles');
	die();

	
});
$app->get('/addV',function($request,$response,$args){

	$stations = StationQuery::create()->orderByStationId();
$this->view->render($response, 'addVehicle.html', ["stations" => $stations]);

	});

// //edit station

$app->post('/editVehicle',function($request,$response,$args){
	
	//$this->view->render($response, 'dashboard.html');
	$pid = $_COOKIE['pid'];
	$v = VehiclesQuery::create()->findPk($pid);
	//	$pn->setName($args['name']);
	// 	$pn->save();

	

	$make =  $request->getParam('inputMake');
	$model = $request->getParam('inputModel');
	$year = $request->getParam('inputYear');
	$vin =  $request->getParam('inputVin');
	$mileage = $request->getParam('inputMileage');
	$type = $request->getParam('inputType');
	$license =  $request->getParam('inputLicense');
	$location = $request->getParam('inputLocation');
	$status = $request->getParam('inputService');
	

	$v->setMake($make);
	$v->setModel($model);
	$v->setYear($year);
	$v->setVin($vin);
	$v->setMileage($mileage);
	$v->setType($type);
	$v->setLicensePlate($license);
	$v->setStationId($location);
	$v->setInService($status);
		
		
		
	$v->save();
	header('Location: vehicles');

	die();



	
	});
$app->get('/editV',function($request,$response,$args){
	
	//$this->view->render($response, 'login.html');
	$pid = $_COOKIE['pid'];
	$p = VehiclesQuery::create()->filterByVehicleId($pid)->findOne();
	$stations = StationQuery::create()->find();
	
	$this->view->render($response, 'editVehicle.html',['vehicle'=>$p, 'stations'=>$stations]);



	
	});
//delete station
$app->post('/deleteVehicle',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$p = VehiclesQuery::create()->findPk($pid);
	$p->delete();

	header('Location: vehicles');

	die();
	
	});

// //details from station

$app->get('/viewVehicle',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$p = VehiclesQuery::create()->filterByVehicleId($pid)->findOne();

	$this->view->render($response, 'viewVehicle.html',['vehicle'=>$p]);

	});

//////////////////////////////////////////////////////////////////////
/// Incident Code
//////////////////////////////////////////////////////////////////////

$app->get('/incidents', function ($request, $response, $args) {
	$incidents = IncidentQuery::create()->filterByStationId($_COOKIE['sid'])->find();
	//echo $personell;
	 $this->view->render($response, 'incidents.html',['incidents'=>$incidents]);
	return $response;
});

//add station

$app->post('/addIncident',function($request,$response,$args){

	$date =  $request->getParam('inputDate');
	$incident = $request->getParam('inputType');
	$location = $request->getParam('inputLocation');
	$station =  $request->getParam('inputStation');
	
		

	$i = new Incident();
	


	

	$i->setDate($date);
	$i->setIncidentType($incident);
	$i->setLocation($location);
	$i->setStationId($station);
	$i->save();

	

		
	
	
	header('Location: incidents');
	die();

	
});
$app->get('/addI',function($request,$response,$args){
	$stations = StationQuery::create()->find();

$this->view->render($response, 'addIncident.html',['stations'=>$stations]);

	});

// //edit station

$app->post('/editIncident',function($request,$response,$args){
	
	//$this->view->render($response, 'dashboard.html');
	$pid = $_COOKIE['pid'];

	$i = IncidentQuery::create()->findPk($pid);
	
	

	$date =  $request->getParam('inputDate');
	$incident = $request->getParam('inputType');
	$location = $request->getParam('inputLocation');
	$station =  $request->getParam('inputStation');

	// $name = $request->getParam('inputName');
	// $address = $request->getParam('inputAddress');
	// $license =  $request->getParam('inputLicense');
	// $phone = $request->getParam('inputPhone');
	// $insurance = $request->getParam('inputInsurance');

	$i->setDate($date);
	$i->setIncidentType($incident);
	$i->setLocation($location);
	$i->setStationId($station);

	// $ip->setName($name);
	// $ip->setAddress($address);
	// $ip->setDriverLicense($license);
	// $ip->setPhoneNumber($phone);
	// $ip->setInsuranceNumber($insurance);
		
		
	$i->save();
	//$ip->save();

	header('Location: incidents');
	die();

	
	});
$app->get('/editI',function($request,$response,$args){
	
	//$this->view->render($response, 'login.html');
	$pid = $_COOKIE['pid'];
	$p = IncidentQuery::create()->filterByIncidentId($pid)->findOne();
	$stations = StationQuery::create()->find();
	
	$this->view->render($response, 'editIncident.html',['stations'=>$stations,'incident'=>$p]);

	});
//delete station
$app->post('/deleteIncident',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$p = IncidentQuery::create()->findPk($pid);
	
	
	$p->delete();
	

	header('Location: incidents');

	die();
	
	});

// //details from station

$app->get('/viewIncident',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$p = InvolvedPartyQuery::create()->filterByIncidentId($pid)->find();
	$In =  IncidentQuery::create()->filterByIncidentId($pid)->findOne();

	$this->view->render($response, 'viewIncident.html',['involveds'=>$p,'incident'=>$In]);

	});


////////////////////////////////////
// Involved Party Code
////////////////////////////////////
$app->get('/addIP',function($request,$response,$args){
		$this->view->render($response, 'addIP.html');
});

$app->post('/addIParty',function($request,$response,$args){

		$name = $request->getParam('inputName');
		$address = $request->getParam('inputAddress');
		$license =  $request->getParam('inputLicense');
		$phone = $request->getParam('inputPhone');
		$insurance = $request->getParam('inputInsurance');

		$ip = new InvolvedParty();


		$ip->setName($name);
		$ip->setAddress($address);
		$ip->setDriverLicense($license);
		$ip->setPhoneNumber($phone);
		$ip->setInsuranceNumber($insurance);
		$ip->setIncidentId($_COOKIE['pid']);
		$ip->save();

		
		header('Location: viewIncident');

		die();
});
$app->get('/editIP',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$ip = InvolvedPartyQuery::create()->filterByIncidentId($pid)->findOne();
	$this->view->render($response, 'editIP.html',['involved'=>$ip]);

		
});
$app->post('/editIParty',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
		$name = $request->getParam('inputName');
		$address = $request->getParam('inputAddress');
		$license =  $request->getParam('inputLicense');
		$phone = $request->getParam('inputPhone');
		$insurance = $request->getParam('inputInsurance');
	$ip = InvolvedPartyQuery::create()->filterByIncidentId($pid)->findOne();

	
	$ip->setName($name);
		$ip->setAddress($address);
		$ip->setDriverLicense($license);
		$ip->setPhoneNumber($phone);
		$ip->setInsuranceNumber($insurance);
		
		$ip->save();

		$ip->save();
		header('Location: viewIncident');

		die();
});


$app->post('/deleteIParty',function($request,$response,$args){

	$eid = $_COOKIE['eid'];
	$e = InvolvedPartyQuery::create()->filterByIncidentId($eid)->findOne();
	$e->delete();

	header('Location: viewIncident');

	die();
	
	});

////////////////////////////////////////////////////////////////////
/// Inventory Code
//////////////////////////////////////////////////////////////////////
$app->get('/inventory', function ($request, $response, $args) {
	$inventory = InventoryQuery::create()->filterByStationId($_COOKIE['sid'])->find();
	//echo $personell;
	 $this->view->render($response, 'inventory.html',['inventory'=>$inventory]);
	return $response;
});

//add station

$app->post('/addInventory',function($request,$response,$args){

	$name =  $request->getParam('inputName');
	$brand = $request->getParam('inputBrand');
	$type =  $request->getParam('inputType');
	$condition = $request->getParam('inputCondition');
	$quantity = $request->getParam('inputQuantity');
	$description =  $request->getParam('inputDescription');
	$location = $request->getParam('inputLocation');
	
		

	$s = new Inventory();
	$s->setName($name);
	$s->setBrand($brand);
	$s->setType($type);
	$s->setItemCondition($condition);
	$s->setQuantity($quantity);
	$s->setDescription($description);
	$s->setStationId($location);
	
		
		
		
	$s->save();
	header('Location: inventory');
	die();

	
});
$app->get('/addIn',function($request,$response,$args){
	$stations = StationQuery::create()->find();

$this->view->render($response, 'addInventory.html',['stations'=>$stations]);

	});

// //edit station

$app->post('/editInventory',function($request,$response,$args){
	
	//$this->view->render($response, 'dashboard.html');
	$pid = $_COOKIE['pid'];
	$s = InventoryQuery::create()->findPk($pid);
	//	$pn->setName($args['name']);
	// 	$pn->save();

	

	$name =  $request->getParam('inputName');
	$brand = $request->getParam('inputBrand');
	$type =  $request->getParam('inputType');
	$condition = $request->getParam('inputCondition');
	$quantity = $request->getParam('inputQuantity');
	$description =  $request->getParam('inputDescription');
	$location = $request->getParam('inputLocation');
	

	$s->setName($name);
	$s->setBrand($brand);
	$s->setType($type);
	$s->setItemCondition($condition);
	$s->setQuantity($quantity);
	$s->setDescription($description);
	$s->setStationId($location);
	
		
		
		
	$s->save();
	header('Location: inventory');

	die();



	
	});
$app->get('/editIn',function($request,$response,$args){
	
	//$this->view->render($response, 'login.html');
	$pid = $_COOKIE['pid'];
	$p = InventoryQuery::create()->filterByInventoryId($pid)->findOne();

	$stations = StationQuery::create()->find();

	$this->view->render($response, 'editInventory.html',['inventory'=>$p, 'stations'=>$stations]);
	});
//delete station
$app->post('/deleteInventory',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$p = InventoryQuery::create()->findPk($pid);
	$p->delete();

	header('Location: inventory');

	die();
	
	});

// //details from station

$app->get('/viewInventory',function($request,$response,$args){
	$pid = $_COOKIE['pid'];
	$p = InventoryQuery::create()->filterByInventoryId($pid)->findOne();

	$this->view->render($response, 'viewInventory.html',['inventory'=>$p]);

	});
///////////////////////////
//// Supervisors Code
//////////////////////////

$app->get('/supervisors', function ($request, $response, $args) {
	$supervisors = SupervisorsQuery::create()->find();
	//echo $personell;
	 $this->view->render($response, 'supervisors.html',['supervisors'=>$supervisors]);
	return $response;
});
// add supervisor
$app->post('/addSupervisor',function($request,$response,$args){

	
		
		$name =  $request->getParam('name');
		$address = $request->getParam('address');
		$height = $request->getParam('height');
		$weight = $request->getParam('weight');
		$phone = $request->getParam('phoneNumber');
		$ssn = $request->getParam('ssn');
		$shift = $request->getParam('inputShift');
		$cert = $request->getParam('inputCert');
		$station = $_COOKIE['sid'];
		$rank = $request->getParam('rank');


		$p = new Personnel();
		$p->setName($name);
		$p->setAddress($address);
		$p->setHeight($height);
		$p->setWeight($weight);
		$p->setPhoneNumber($phone);
		$p->setSsn($ssn);
		$p->setShiftId($shift);
		$p->setCertificationId($cert);
		$p->setStationId($station);
		$p->save();
		//echo $p->getPersonnelId();
		//echo $p;

		echo 'done!';

		 $s = new Supervisors();
		 $s->setRank($rank);
		 $s->setPersonnelId($p->getPersonnelId());
		 $s->save();
		header('Location: supervisors');

		die();

	
});
$app->get('/addSup',function($request,$response,$args){
	$station = $_COOKIE['sid'];
	$s = ShiftQuery::create()->filterByStationId($station)->find();
	$cert = CertificationsQuery::create()->find();

	$this->view->render($response, 'addSupervisor.html', ['shifts'=>$s, 'certifications'=>$cert]);

});

$app->get('/editSup',function($request,$response,$args){
	
	//$this->view->render($response, 'login.html');
	$pid = $_COOKIE['pid'];
	
	$p = SupervisorsQuery::create()->filterBySupervisorId($pid)->findOne();
	//echo $p;
	//echo $p;
	$station = $_COOKIE['sid'];
	//echo $station;
	$s = ShiftQuery::create()->filterByStationId($station)->find();
	$cert = CertificationsQuery::create()->find();
	$this->view->render($response, 'editSupervisor.html',['supervisor'=>$p,'shifts'=>$s,'certifications'=>$cert]);



	
	});
$app->post('/editSupervisor',function($request,$response,$args){

	
		$pid = $_COOKIE['pid'];
		$name =  $request->getParam('name');
		$address = $request->getParam('address');
		$height = $request->getParam('height');
		$weight = $request->getParam('weight');
		$phone = $request->getParam('phoneNumber');
		$ssn = $request->getParam('ssn');
		$shift = $request->getParam('inputShift');
		$cert = $request->getParam('inputCert');
		$station = $_COOKIE['sid'];
		$rank = $request->getParam('rank');
		$s = SupervisorsQuery::create()->filterBySupervisorId($pid)->findOne();
		

		 $p = PersonnelQuery::create()->filterByPersonnelId($s->getPersonnelId())->findOne();
		
		
		$p->setName($name);
		$p->setAddress($address);
		$p->setHeight($height);
		$p->setWeight($weight);
		$p->setPhoneNumber($phone);
		$p->setSsn($ssn);
		$p->setShiftId($shift);
		$p->setCertificationId($cert);
		$p->setStationId($station);
		$p->save();
		//echo $p->getPersonnelId();
		//echo $p;

		

		
		 $s->setRank($rank);
		 //$s->setPersonnelId($p->getPersonnelId());
		 $s->save();
		header('Location: supervisors');

		die();

	
});

$app->post('/deleteSupervisor',function($request,$response,$args){

	$pid = $_COOKIE['pid'];
	$s = SupervisorsQuery::create()->filterBySupervisorId($pid)->findOne();
		

	$p = PersonnelQuery::create()->filterByPersonnelId($s->getPersonnelId())->findOne();
		 
	$s->delete();
	$p->delete();
	header('Location: supervisors');

	die();
	
	});
$app->get('/viewSupervisors', function ($request, $response, $args) {
	$pid = $_COOKIE['pid'];
	$s = SupervisorsQuery::create()->filterBySupervisorId($pid)->findOne();
	//echo $personell;
	$e = PersonnelEquipmentQuery::create()->filterByPersonnelId($s->getPersonnelId());

	//$c = CertificationsQuery::create()->filterByPersonnelId($pid)->findOne();
	

	$this->view->render($response, 'viewSupervisors.html',['equipments'=>$e,'supervisor'=>$s]);

});

//////////////////////
// App run
//////////////////////
$app->run();