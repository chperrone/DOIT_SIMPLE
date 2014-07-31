<?php

	$con = mysqli_connect("localhost", "root", "root", "DOIT");

	if ( mysqli_connect_errno() ) {
		echo "Could not connect";
		exit();
	}

	$VALUES_V = [5,15,100,100,250,300,300,50,100,300,200,700,200,100,200,
            200,200,300,50,200,50,200,1000,300,50,50,200,300,250,100,100,150,200,500,200,500,
            500,100,100,400,200,200,300,100,200,300,300,500,100,300,300,200,100,200,300,1000,
            300,200,200,300,200,200,200,300,100,100,100,100,100,300,400,200,200,200,1000,300,300,300,400,
            200,200,100,200,100,1000,200,200,100,200,300,400,200,500,200,1500,300,400,300,100,400,200,25,100,100,200,
            100,200,1500,200,100,400,150,500,500,200,200,100,100,200,100,100,100,500,300,100,100,100,200,100,200,200,
            300,500,100,200,300,500,400,300,200,100,200,300,100,100,200,2000,200,100,300,100,100,500,500,500,1000,1000,
            1000,50,500,300,300,400,3000,400,500,300,500,500,500,1000,200,300,300,300,400,400,400,500,600,100,100,
            100,200,300,300,300,400,100,100,100,500,500,200,500,500,500,500,200,50,200,200,500,200,400,1000,200,
            300,500,200,100,300];

    $VIOLATIONS_BY_CAT = [" Trash "," Overgrown Weeds "," Graffiti "," Trash "," Trash "," Permit/Registration ",
		" Safety/Fire Protection "," Other "," Other ",
		" Permit/Registration "," Permit/Registration ", " Trash "," Other "," Other "," Permit/Registration ",
		" Permit/Registration "," Repair/Maintenance ",
		" Safety/Fire Protection ", " Permit/Registration "," Safety/Fire Protection "," Other ", " Graffiti ",
		" Cleanliness "," Permit/Registration ",
		" Repair/Maintenance "," Repair/Maintenance "," Permit/Registration "," Other "," Repair/Maintenance "," Trash ",
		" Permit/Registration "," Safety/Fire Protection "," Safety/Fire Protection "," Trash "," Safety/Fire Protection ",
		" Repair/Maintenance "," Permit/Registration "," Other "," Safety/Fire Protection ",
		" Other "," Permit/Registration "," Safety/Fire Protection "," Repair/Maintenance "," Permit/Registration ",
		" Other "," Other "," Permit/Registration "," Safety/Fire Protection ",
		" Other "," Permit/Registration "," Trash "," Other ",
		" Other "," Permit/Registration "," Other "," Trash ",
		" Other "," Other "," Other "," Safety/Fire Protection ",
		" Other "," Other "," Other "," Permit/Registration ",
		" Safety/Fire Protection "," Safety/Fire Protection ",
		" Safety/Fire Protection "," Other "," Other "," Safety/Fire Protection ",
		" Fire Protection Systems "," Other "," Repair/Maintenance "," Safety/Fire Protection ",
		" Trash "," Safety/Fire Protection "," Safety/Fire Protection ",
		" Safety/Fire Protection "," Safety/Fire Protection "," Safety/Fire Protection "," Other ",
		" Safety/Fire Protection "," Other "," Other "," Trash ",
		" Other "," Safety/Fire Protection "," Other "," Repair/Maintenance ",
		" Safety/Fire Protection "," Safety/Fire Protection "," Safety/Fire Protection ",
		" Other "," Other "," Trash "," Safety/Fire Protection ",
		" Safety/Fire Protection "," Other "," Other "," Safety/Fire Protection ",
		" Other "," Trash "," Other "," Other "," Permit/Registration "," other ",
		" Safety/Fire Protection "," Trash "," Repair/Maintenance "," Safety/Fire Protection "," Safety/Fire Protection ",
		" Trash "," Safety/Fire Protection "," Other "," Other ",
		" Other "," Permit/Registration "," Safety/Fire Protection "," Safety/Fire Protection ",
		" Other "," Other "," Safety/Fire Protection "," Repair/Maintenance "," Safety/Fire Protection ",
		" Other "," Other "," Repair/Maintenance "," Permit/Registration ",
		" Repair/Maintenance "," Other "," Permit/Registration ",
		" Safety/Fire Protection "," Safety/Fire Protection "," Other "," Other ",
		" Other "," Other "," Other "," Trash "," Safety/Fire Protection ",
		" Other "," Other "," Other "," Safety/Fire Protection "," Safety/Fire Protection "," Other ",
		" Trash "," Other "," Other "," Safety/Fire Protection "," Permit/Registration ",
		" Other "," Other "," Other "," Safety/Fire Protection "," Other ",
		" Other "," Safety/Fire Protection "," Other "," Maintenance/Fire Protection "," Other ",
		" Safety/Fire Protection "," Other "," Trash "," Other "," Other ",
		" Other "," Safety/Fire Protection "," Safety/Fire Protection "," Safety/Fire Protection ",
		" Safety/Fire Protection "," Safety/Fire Protection "," Other "," Safety/Fire Protection ",
		" Safety/Fire Protection "," Safety/Fire Protection "," Other "," Other ",
		" Safety/Fire Protection "," Other "," Other "," Safety/Fire Protection "," Other ",
		" Other "," Other "," Other "," Safety/Fire Protection ",
		" Other "," Other "," Safety/Fire Protection "," Other ",
		" Other "," Safety/Fire Protection "," Other "," Other ",
		" Other "," Safety/Fire Protection "," Other "," Other ",
		" Other "," Safety/Fire Protection "," Other "," Safety/Fire Protection ",
		" Safety/Fire Protection "," Other "," Trash "," Permit/Registration "," Permit/Registration ",
		" Safety/Fire Protection "," Safety/Fire Protection "," Trash "];

		$VIOLATIONS = [" Improper storage trash: res "," Overgrown Weeds On Property "," Graffiti on building- 1 ",
		" Overfilling of barrel "," Illegal dumping < 1 cubic yd "," Maint a dumpster wopermit "," Unsafe Structure ",
		" Protection of Adj. Property "," Right of Entry "," Unregistered motor vehicles- 2 "," Failure to Obtain Permit ",
		" Illegal dumping 1-5 cubic yd.: "," Mass. State Electrical Code "," Supervision of Electricians "," Working Without a Permit ",
		" Failure to Secure Permit "," Maintenance "," Fire  & Smoke Alarm Systems ",
		" Unregistered motor vehicles-1 "," Unsafe & Dangerous "," Board Up Property (Ch 139-3A) ",
		" Graffiti on building- 2 "," Site Cleanliness license ? VIO "," Posting signs wo authority "," No Number On A Building ",
		" Street Numbers "," Illegal Vending "," Fail to post management comp "," Non-Emergency Auto Repair "," Trash illegally dump container ",
		" Certificate of Occupancy "," Removal snow private property "," Exits "," Illegal dumping park "," Exit passageways ",
		" Maintenance of Exterior "," Unlawful Continuance "," Referenced Codes & Standards "," Illumination ",
		" Mass State Plumbing Code "," Required Inspections "," Ramps "," Egress Maintenance "," Permits ",
		" Mechanical Execution of Work "," Elec. Equip. & Connections "," Failure To Register "," Unsafe and Dangerous ",
		" Enforcement "," Failure to secure a Re-Inspect "," disposal med waste "," Wiring Integrity ",
		" Electrical Connections "," Electrical Work w/out Permit "," Prohibited Locations "," Illegal dumping w a vehicle ",
		" Approval of Documents "," Certificate of Inspection  "," Abutting a public street "," Means of Egress ",
		" Guarding of Live Ports "," Integrity of Elec. Equip. "," Guarding of Live parts "," Electrical Work w/out a Permit ",
		" Failure clear sidewalk - snow "," Failure clear sidewalk - snow: ",
		" Removal snow private prop "," Integrity of elec. equipment "," Circuit Intensity "," Emergency Escape & Rescue ",
		" Fire Protection Systems "," Wiring Methods "," Corridor Obstruction "," Monitoring Fire Alarm Systems ",
		" Illegal dumping 5 cubic yd. "," Fire Protection & Life Safety "," Portable Fire Extinguishers ",
		" Means of egress doors "," Exits Maintained "," Minimum Number of Exits "," Locks and Latches ",
		" Handrails/safety "," Electrical equipment integrity "," Exposed work "," Illegal dumping 5+ cubic yd ",
		" Live loads(roof) "," Accessible Means of Egress "," Imbedded posts&poles "," Testing&Maintenance Sprinklers ",
		" Fire Alarm Systems "," Carbon monoxide alarms "," Fire Wall/Fire Resistance ",
		" Occupancy "," Amended Constuction documanets "," Illegal dumping Const debris "," Horozontal assemblies;Fire ",
		" Fire-resistance rating "," Failure of Delivery Standards "," Sign: Zoning Code Art 11-2&sub "," Fire Alarm Ent. Response ",
		" Workmanship "," Littering "," Minimum Requirements "," Size and Rating "," Approval required "," Illegally occupied prior to CO ",
		" Smoke alarm locations "," Illegal dumping 1-5 cuyd. "," General Repairs "," Pool barrier "," Access to Public Way ",
		" Large building recycling- 1 "," Unsafe Structures "," Ungrounded Conducters "," Means of Attachment ",
		" Referenced Codes "," Construction Documents "," Exit Signs "," Emergency Escape ",
		" Specialized codes "," Floor Surface "," Handrails "," Proper Maintenance "," Emergency escape and rescue ",
		" Failure to call Inspections "," Protection of conductors "," Unsafe Maintenance "," Clearance ",
		" Maintenance of Facilities "," Temporary Wiring Methods "," Failure to secure inspections ",
		" Egress thru Intervening Spaces "," Hazrdous Means of Egress "," Certificate of Inspection "," Seperation Walls ",
		" Wiring "," Unlawful Acts "," Operational Constraints "," Large building recycling - 2 "," Fire Alarm and Detection ",
		" Retaining Wall "," Corridors "," Effect of Non-Conforming Use "," Gates "," Fire Walls "," Elevator Lobbies ",
		" Illegal dumping  vehicle: "," Pull & Junction Boxes "," Wiring Intensity "," Exit Access "," Installation, uses permitted ",
		" Guards Where Required "," Water Accumulation "," Objectionable Current "," Smoke Alarms "," Damp or Wet Locations ",
		" Arcing Parts "," Unsafe Building & Structures "," Crying out wares- 1 "," Maintenance/Fire Protection "," Maximum Height from Floor ",
		" Construction Safeguards "," Mounting Elec. Equipment "," Illegal dumping: Haz Waste "," Bolt Locks "," Bathrooms ",
		" Illegal Temporary Wiring "," Means of Egress Illumination "," Smoke Detectors "," Fire Warning Systems ",
		" Carbon Monoxide Protection "," Unsafe Mechanical Equipment "," Boxes Construct & Install "," Fire Escape Affidavit ",
		" Overcurrent Protection "," Fire Alarm & Detection "," Side Yard Requirements "," Grounding electrode conduction ",
		" Egress "," Manner of Removal "," Excessive Use of Ext. Cords "," Removal/Making Structure Safe "," Covers & Canopies ",
		" False Statements "," Violation penalties "," Improper Electrical Repair "," Rem Dangerous/Abandoned Struct ",
		" Failure to call for req Insp. "," Licensed Supervisor "," Fire Partitions "," Spaces about Elect. Equip. ",
		" Building Illegally Occupied "," Hazardous Means of Egress "," Ventilation "," Electrical Rm Used for Storage ",
		" Elevated Electrical Room "," Access to a Publicway "," Door Locks "," Disconnecting Means Service ",
		" Abusive Language In Solicitati "," Remove/Making Safe Structure "," Abandoned Cable "," Carbon Monoxide Detectors ",
		" Hand Rails "," Basements "," Illegal dumping solid waste "," Clearance on Buildings "," Permit Secured by Owner ",
		" Emergency Escape and Rescue Op "," Fences "," Exit Signs & Lights "," Illegal Dumping (vehicle) "];

		$VIOLATIONS_PROPER = [" Improper Residential Trash Storage "," Overgrown Weeds On Property "," Graffiti on building ",
		" Overfilling of Trash Barrel "," Illegal dumping (less than 1 cubic yards) "," Maintanance of dumpster without Permit "," Unsafe Structure ",
		" Protection of Adjacent Property "," Right of Entry "," Unregistered motor vehicles "," Failure to Obtain Permit ",
		" Illegal dumping (1-5 cubic yards) "," MA State Electrical Code "," Supervision of Electricians "," Working Without a Permit ",
		" Failure to Secure Permit "," Maintenance "," Fire  & Smoke Alarm Systems ",
		" Unregistered motor vehicles "," Unsafe & Dangerous "," Boarded Up Property ",
		" Graffiti on building "," Site Cleanliness license Violation "," Posting Signs without Authority "," No Number On A Building ",
		" Street Numbers Missing "," Illegal Vending "," Fail to post management company "," Non-Emergency Auto Repair "," Trash illegally dumped in container ",
		" Certificate of Occupancy "," No Removal of snow at private property "," Exits "," Illegal dumping park "," Exit passageways ",
		" Maintenance of Exterior "," Unlawful Continuance "," Referenced Codes & Standards "," Illumination ",
		" MA State Plumbing Code "," Required Inspections "," Ramps "," Egress Maintenance "," Permits ",
		" Mechanical Execution of Work "," Electrical Equipment & Connections "," Failure To Register "," Unsafe and Dangerous ",
		" Enforcement "," Failure to secure a Re-Inspect "," disposal of medical waste "," Wiring Integrity ",
		" Electrical Connections "," Electrical Work without Permit "," Prohibited Locations "," Illegal dumping with a vehicle ",
		" Approval of Documents "," Certificate of Inspection  "," Abutting a public street "," Means of Egress ",
		" Guarding of Live Ports "," Integrity of Electrical Equip. "," Guarding of Live parts "," Electrical Work without a Permit ",
		" Failure clear sidewalk of snow "," Failure clear sidewalk of snow: ",
		" No Removal of snow at private property "," Integrity of electrical equipment "," Circuit Intensity "," Emergency Escape & Rescue ",
		" Fire Protection Systems "," Wiring Methods "," Corridor Obstruction "," Monitoring Fire Alarm Systems ",
		" Illegal dumping (5 cubic yards) "," Fire Protection & Life Safety "," Portable Fire Extinguishers ",
		" Means of egress doors "," Exits Maintained "," Minimum Number of Exits "," Locks and Latches ",
		" Handrails/safety "," Electrical equipment integrity "," Exposed work "," Illegal dumping (More than 5 cubic yd) ",
		" Live loads on roof "," Accessible Means of Egress "," Imbedded posts and poles "," Testing & Maintenance of Sprinklers ",
		" Fire Alarm Systems "," Carbon monoxide alarms "," Fire Wall/Fire Resistance ",
		" Occupancy "," Amended Constuction documents "," Illegal dumping Construction debris "," Horizontal assemblies, Fire hazard ",
		" Fire-resistance rating "," Failure of Delivery Standards "," Sign: Zoning Code "," Fire Alarm Response ",
		" Workmanship "," Littering "," Minimum Requirements "," Size and Rating "," Approval required "," Illegally occupied prior ",
		" Smoke alarm locations "," Illegal dumping (1-5 cubic yards) "," General Repairs "," Pool barrier "," Access to Public Way ",
		" Large building recycling "," Unsafe Structures "," Ungrounded Conducters "," Means of Attachment ",
		" Referenced Codes "," Construction Documents "," Exit Signs "," Emergency Escape ",
		" Specialized codes "," Floor Surface "," Handrails "," Proper Maintenance "," Emergency escape and rescue ",
		" Failure to call Inspections "," Protection of conductors "," Unsafe Maintenance "," Clearance ",
		" Maintenance of Facilities "," Temporary Wiring Methods "," Failure to secure inspections ",
		" Egress through Intervening Spaces "," Hazrdous Means of Egress "," Certificate of Inspection "," Seperation Walls ",
		" Wiring "," Unlawful Acts "," Operational Constraints "," Large building recycling "," Fire Alarm and Detection ",
		" Retaining Wall "," Corridors "," Effect of Non-Conforming Use "," Gates "," Fire Walls "," Elevator Lobbies ",
		" Illegal dumping of vehicle "," Pull & Junction Boxes "," Wiring Intensity "," Exit Access "," No Permit for Installation ",
		" Guards Where Required "," Water Accumulation "," Objectionable Current "," Smoke Alarms "," Damp or Wet Locations ",
		" Arcing Parts "," Unsafe Building & Structures "," Crying out wares "," Maintenance/Fire Protection "," Maximum Height from Floor ",
		" Construction Safeguards "," Mounting Electrical Equipment "," Illegal dumping of Hazardous Waste "," Bolt Locks "," Bathrooms ",
		" Illegal Temporary Wiring "," Means of Egress Illumination "," Smoke Detectors "," Fire Warning Systems ",
		" Carbon Monoxide Protection "," Unsafe Mechanical Equipment "," Boxes Construction and Installation "," Fire Escape Affidavit ",
		" Overcurrent Protection "," Fire Alarm & Detection "," Side Yard Requirements "," Grounding electrode conduction ",
		" Egress "," Manner of Removal "," Excessive Use of External Cords "," Removal/Making Structure Safe "," Covers & Canopies ",
		" False Statements "," Violation penalties "," Improper Electrical Repair "," Rem Dangerous/Abandoned Struct ",
		" Failure to call for required Inspection "," Licensed Supervisor "," Fire Partitions "," Spaces about Elect. Equip. ",
		" Building Illegally Occupied "," Hazardous Means of Egress "," Ventilation "," Electrical Room Used for Storage ",
		" Elevated Electrical Room "," Access to a Publicway "," Door Locks "," Disconnecting Means Service ",
		" Abusive Language In Solicitation "," Remove/Making Safe Structure "," Abandoned Cable "," Carbon Monoxide Detectors ",
		" Hand Rails "," Basements "," Illegal dumping solid waste "," Clearance on Buildings "," Permit Secured by Owner ",
		" Emergency Escape and Rescue "," Fences "," Exit Signs & Lights "," Illegal Dumping of vehicle "];

		$CRIMES = ["CRIMES AGAINST CHILDREN" , "HOMICIDE" , "ARSON" , "HATECRIM" , "32GUN" , "WEAPONS CHARGE" ,
            "AGGRAVATED ASSAULT" , "BIOTHREAT" , "DEATH INVESTIGATION" , "HARASS" , "TRESPASS" , "BOMB" , "EXPLOS" , "OTHER LARCENY" ,
            "RESIDENTIAL BURGLARY" , "AUTO THEFT" , "ROBBERY" , "FIRE" , "PRISON" , "COMMERCIAL BURGLARY" , "PROPDAM",
            "STOLEN PROPERTY CHARGES" , "OPERATING UNDER INFLUENCE" , "GATHER" , "INVPER" , "DRUG CHARGES" , "LANDLORD" , "PUBDRINK" ,
            "DISORDERLY" , "PROSTITUTION CHARGES" , "GAMBLING OFFENSE" , "ARGUE" , "VANDALISM" , "SIMPLE ASSAULT" ,
            "LABOR" , "PLATES", "MANSLAUG"];
        
        $CRIME_CATEGORIES = ["Violence" , "Homicide" , "Other" , "Violence" , "Weapons" , "Weapons" ,
            "Violence" , "Other" , "Violence" , "Harassement" , "Property" , "Other" , "Other" , "Larceny/Theft/B&E" , 
            "Larceny/Theft/B&E" , "Larceny/Theft/B&E" , "Robbery" , "Other" , "Other" , "Larceny/Theft/B&E" , 
            "Property", "Property" , "Other" , "Noise/Disturbance" , "Harassement" , "Drug" ,
            "Property" , "Noise/Disturbance" , "Noise/Disturbance" , "Prostitution" , 
            "Other" , "Noise/Disturbance" , "Property" , "Simple Assault" , "Other" , "Other", "Violence"];
        
        $CRIME_VALUES = [10,10,6,7,5,5,4,3,6,3,2,3,3,4,4,5,4,3,2,3,3,3,3,5,2,4,4,7,7,3,2,3,2,3,1,1,8];

        echo "Tables emptied</br>";
        mysqli_query($con, 'TRUNCATE TABLE violations');
        mysqli_query($con, 'TRUNCATE TABLE crimes');

        echo "violations populated</br>";
		for ($i = 0; $i < count($VIOLATIONS); $i++) {

			$short = trim($VIOLATIONS[$i]);
			$proper = trim($VIOLATIONS_PROPER[$i]);
			$category = trim($VIOLATIONS_BY_CAT[$i]);
			$val = (int)$VALUES_V[$i];

			mysqli_query($con, "INSERT INTO violations
								VALUES ('$short', '$proper', '$category', '$val')");
		}

		echo "crimes populated</br>";
		for ($i = 0; $i < count($CRIMES); $i++) {

			$name = trim($CRIMES[$i]);
			$category = trim($CRIME_CATEGORIES[$i]);
			$value = trim($CRIME_VALUES[$i]);

			mysqli_query($con, "INSERT INTO crimes
								VALUES ('$name', '$category', '$value')");
		}

		mysql_close($con);
		echo "Database Updated!";
?>