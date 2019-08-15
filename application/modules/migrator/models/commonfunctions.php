<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class commonfunctions extends CI_Model {
	public function formatName($name){
		if (substr_count($name, '-') > 0){
			$name = mb_strtolower($name);
			$name = implode('-', array_map('ucfirst', explode('-', $name)));
		} else {
			$name = ucwords(mb_strtolower($name));
		}
		return $name;
	}

	public function getGender($gender){
		if($gender == 'Male'){
			return 'M';
		} elseif ($gender == 'Female'){
			return 'F';
		} else {
			return '';
		}
	}

	public function eraseDoubleSpace($holder){
		$a = [];
		$temp = '';
		for ($i=0; $i < strlen($holder); $i++) { 
			if (substr($holder, $i, 1) == ' ' and substr($holder, $i+1, 1) == ' ') {
					
			} else {
				array_push($a, substr($holder, $i, 1));
			}
		}
		for ($i=0; $i < sizeof($a); $i++) { 
			$temp = $temp.$a[$i];
		}
		return $temp;
	}

	public function addDeleteWordCity($holder){
		switch (substr_count(strtolower($holder), 'city')) {
			case '0':
					$holder = $holder. " City";
					break;
			case '1':
					$holder = trim(substr($holder, 0, strpos(strtolower($holder), 'city')));
					break;
		}
		return $holder;	
	}

	public function renameCity($holder){
		//using falling cases, careful if you want to add another case
		switch (trim($holder)) {
			case 'Mandue City':
						$holder = 'Mandaue City';
						break;

			case 'Cagayn De Oro City':
			case 'CAGAYAN DE ORO CITTY':
			case 'CAGAYAN DE ORO CIT':	
			case 'CAGAYAN DE ORO CTIY':	
			case 'CDO CITY':
			case 'CDO':	
			case 'CDOC':	
			case 'CAGAYAN DE ORO C ITY':
						$holder = 'Cagayan de Oro';
						break;

			case 'Las Piñas':		
			case 'LAS PIÑAS':					
			case 'LAS PIÑAS CITY':
						$holder = 'Las Piñas';
						break;
			
			case 'Dasmariñas':
						$holder = 'Dasmariñas City';
						break;

			case 'MUNTILUPA':
						$holder = 'Muntinlupa';
						break;

			case 'Mandaluyung City':
						$holder = 'Mandaluyong';
						break;

			case 'OZAMIS CITY':
						$holder = 'Ozamiz City';
						break;

			
			case 'Parañaque City':
			case 'PARAÑAQUE':
			case 'PARAÑAQUE CITY':			
			case 'Paranaque City':
						$holder = 'Parañaque';
						break;			
					
				}
		return $holder;
	}

	public function renameProvince($holder){
		switch (trim($holder)) {
			//falling cases, careful in adding
			case 'ADN':
						$holder = 'Agusan del Norte'; 
						break;

			case 'AGN':
						$holder = 'Agusan del Norte';					 
						break;

			case 'Camiguin Province':
						$holder = 'Camiguin'; 
						break;

			case 'LANAOO DEL SUR':
						$holder = 'Lanao del Sur';	 
						break;
			case 'LDN':
						$holder = 'Lanao del Norte';						 
						break;

			case 'MISAMIS ORIETAL':
			case 'MISAMIS OREINTAL':
			case 'MISAMS ORIENTAL':
			case 'MISAMIS ORIENTAL V':
			case 'MISAMIS ORIENAL':
			case 'Mis Or':
			case 'Mis. Or.':
			case 'MIS. OR.':
			case 'MIS.OR.':
						$holder = 'Misamis Oriental';					
						break;

			case 'MIS. OCC.':
						$holder = 'Misamis Occidental';					
						break;	
			
			case 'SDN':
						$holder = 'Surigao del Norte';						 
						break;
			default:
						# code...
						break;
				}
		return $holder;
	}
	
	public function checkCompany($company){
		$dictionary = array( 
			'2006',
			'A C M D C',
			'ABCI',
			'ABERDI',
			'Accessories',
			'Account',
			'Adjustment',
			' Ads',
			'Advertising',
			'Agency',
			'Aggregrates',
			'Agri.',
			'Agricultural',
			'AGRICULTURAL',
			'Aircon',
			'Allowance',
			'Altech ',
			'Appliance',
			'Architect',
			'Associates',
			'Assurance',
			'Auto ',
			'Automo',
			'Autoworld',
			'B. Park',
			'Bank',
			'Balance',
			'BDO-',
			'Benefits',
			'Bicycle',
			'BICYCLE',
			'BIR',
			'Bookstore',
			'Briefing',
			'builder',
			'Builder',
			'Bureau',
			'Business',
			'CARRIER',
			'C D O',
			'CDO',
			'Center',
			'C E P A L C O',
			'CEPALCO',
			'Charges',
			'Chemicals',
			'CIP -',
			'City Ads',
			'Co.',
			'Commercial',
			'Commission',
			'Communication',
			'Company',
			'Component',
			'Computer',
			'Concrete',
			'Concreting',
			'Congress',
			'Cons.',
			'Constech',
			'Const.',
			'Const Bond',
			'Construction',
			'Consultancy',
			'Continental',
			'Control',
			'Coop',
			'COOP',
			'Copyfax',
			'Corp.',
			'Corporation',
			'CORPORATION',
			'Corpus Christi',
			'Cost ',
			'Couture',
			'CUSTOMERS',
			'Daily',
			'de Oro',
			'De Oro',
			'Design',
			'Desmark',
			'Development',
			'Devt',
			'DEVT',
			"DEV'T",
			'Directories',
			'Directors',
			'Distributor',
			'Drilling',
			'Education',
			'EduChild',
			'ELECTRIC',
			'Electric',
			'Electro',
			'Employees',
			'Engineer',
			'Ent.',
			'Enterprise',
			'Equipment',
			'Estate',
			'Event',
			'Expenses',
			'FASHION',
			'Fashion',
			'FGBMFI',
			'Finishing',
			'Flower',
			'Footprints',
			'Forest',
			'Form',
			'Foundation',
			'From ',
			'Fruits',
			'Fund',
			'Furnishing',
			'Gaisano',
			'GAITS',
			'Garden',
			'Garment',
			'General',
			'Geoex',
			'Glass',
			'Global',
			'Globe',
			'Golden',
			'Graphic',
			'Gratika',
			'Gravel',
			'Grocery',
			'H. S. A.',
			'Hapit-Anay',
			'hardware',
			'Hardware',
			'HDMF',
			'Health',
			'HEMO',
			'Holding',
			'Hollow blocks',
			'Hollowblock',
			'Home ',
			'Homefield',
			'Homeowners',
			'Hotel',
			'House',
			'Housing',
			'Hydraulic',
			'I. N. P. C.',
			'Import',
			'Inc.',
			'Incorporated',
			'Industrial',
			'Insurance',
			'Integrated',
			'Interest',
			'International',
			'Interserve',
			'Inv.',
			'Janitorial',
			'JCA',
			'KAISA',
			'KASAMA',
			'Knight',
			'LANAI',
			'Land ',
			' Law ',
			'Lighting',
			'Local',
			'Lotbuyers',
			'Lower',
			'Ltd.',
			'LTD.',
			'LUMBER',
			'Machine',
			'Maintenance',
			'Manage',
			'Manufactur',
			'MANUFACTUR',
			'Marble',
			'Marketing',
			'Marine',
			'Maxicare',
			'MDK',
			'Memorial',
			'Metal',
			'Mechandise',
			'Merchandis',
			'Mgmt ',
			'Milling',
			'Mindanao',
			'Mining',
			'Misposting',
			'Mktg',
			'Month',
			'MORESCO',
			'Motor',
			'Mountain',
			'Municipal',
			'NKAC',
			'NMDB',
			'NMMDC',
			'Northmin',
			'Nursery',
			'Office',
			'Others',
			'OTHERS',
			'P1-',
			'P2-',
			'P3 -',
			'Pacific ',
			'Paints',
			'Paper',
			'Parasat',
			'Partners',
			'Parts',
			'Payroll',
			'PAYROLL',
			'Pest ',
			'PestMaster',
			'PEZA',
			'Phil.',
			'Philippine',
			'PHILEX',
			'PHILRES',
			'Phils',
			'Pioneer',
			'Place',
			'Plumbline',
			'Pools',
			'Postage',
			'Power',
			'Prepaid',
			'Press',
			'Print',
			'Product',
			'Professional',
			'Propert',
			'Publishing',
			'Pumphouse',
			'Purpose',
			'RAVANERA',
			'RCBC',
			'Real Est',
			'Realty',
			'Recapping',
			'Refundable',
			'Registry',
			'Rental',
			'Repair',
			'Resorces',
			'Resource',
			'Retainer',
			'River Canyon',
			'Riverview',
			'Roadnet',
			'Roadside',
			'Rovency',
			'RUBBER',
			'Salaries',
			'School',
			'Security',
			'Service',
			'services',
			'Seven',
			'Shop',
			'Signages',
			'SLERS',
			'Southbank',
			'Sports',
			'Station',
			'Steel',
			'Store',
			'Style',
			'Subscription',
			'SUGECO',
			'Superstore',
			'Suppliers',
			'Supply',
			'Surplus',
			'Survey',
			'System',
			'SYSTEM',
			'Tailor',
			'Technolog',
			'Telecommunication',
			'Telephone',
			'Temporary',
			'Terra ',
			'Timber',
			'Tires',
			'Tourism',
			'Trader',
			'Trading',
			'Training',
			'Trans.',
			'Transfer',
			'Travel',
			'Treasurer',
			'Trucking',
			'Trusses',
			'Ultimate',
			'UNIQUARTS',
			'University',
			'Upholstery',
			'Utilities',
			'Various',
			'VCR',
			'Vehicle',
			'Ventures',
			'Verification',
			'W W B',
			'WAPCO',
			'Warehse',
			'Water',
			'WBC',
			'Westbridge',
			'Wirtgen',
			'Wood',
			'Works',
			'XEWS',
			'Year End'
		);


		$tick = false;
		for ($i=0; $i < sizeof($dictionary); $i++) { 
			if (substr_count($company, $dictionary[$i]) > 0){
				$tick = true;
				break;
			}
		}
		return $tick;
	}

	public function deleteType($holder){
		$dictionary = array( 
			'Acc. Cost',
			'Adjustment',
			'B. Park',
			'Bank Charges',
			'CIP ',
			'Const. Bond',
			'Cost of',
			'Directors',
			'Equipment Operator',
			'Find',
			'For Verification',
			'From CAINTA',
			'Gargar',
			'General Acct',
			'Greenhills Properties',
			'Head  Office',
			'Inv. in RE',
			'Maint. Allowance',
			'Misposting',
			'Opening',
			'Others',
			'OTHERS',
			'P1-',
			'P2-',
			'P3 -',
			'P4-',
			'Prepaid Rent',
			'Refundable Dep',
			'Suppliers',
			'Temporary',
			'Trans. Fee',
			'Transfer fee',
			'Transfer Fee',
			'Various Contractors',
			'VARIOUS CUSTOMERS',
			'Various Employees',
			'Various Lotbuyers',
			'Water Guar. Dep.',
			'Xavierville Houses',
			'XEWS-'
		);


		$tick = false;
		for ($i=0; $i < sizeof($dictionary); $i++) { 
			if (substr_count($holder, $dictionary[$i]) > 0 ){
				$tick = true;
				break;
			}
		}
		return $tick;
	}
}