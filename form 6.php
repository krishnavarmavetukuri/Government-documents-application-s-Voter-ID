
<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votersdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve the list of states
$sql = "SELECT StateCode, StateName FROM States";
$result = $conn->query($sql);

// Check if there are any states available
if ($result->num_rows > 0) {
    // Initialize an empty array to store the states
    $states = [];

    // Fetch each row of the result and add it to the states array
    while ($row = $result->fetch_assoc()) {
        $states[] = $row;
    }
} else {
    // Handle the case where no states are available
    echo "No states found!";
}




// Close the database connection
$conn->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 6 - New Voter Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f5f5f5;
        }
        .header {
        background-color: #343a40;
        color: white;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: fixed; /* Fixed positioning to keep it at the top */
        width: 100%; /* Take up the full width of the viewport */
        z-index: 1000; /* Ensure the header appears above other content */
        top: 0; /* Position it at the top of the viewport */
    }

        .header img {
            height: 50px;
        }
        .header-title {
            display: flex;
            align-items: center;
        }
        .header-title h1 {
            margin-left: 10px;
            font-size: 24px;
            font-weight: 500;
            color: white;
        }
        .header-user {
            display: flex;
            align-items: center;
        }
        .header-user img {
            height: 50px;
            margin-right: 10px;
        }
   

        
        .sidebar {
        width: 250px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: fixed; /* Keep the sidebar fixed */
        height: 100%;
        overflow-y: auto;
        top: 60px; /* Adjusted to match the height of the header */
        left: 0; /* Position it at the left side */
        }

        .sidebar h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            margin: 10px 0;
            color: #333;
            text-decoration: none;
            border: 1px solid #007bff;
            border-radius: 4px;
            background-color: #e9f5ff;
        }

        .sidebar a:hover {
            background-color: #cce0ff;
        }

        .sidebar a .checkmark {
            float: right;
            color: #007bff;
        }

        form {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 280px; /* To make space for the sidebar */
        }

        .error-message {
            color: red;
            display: none;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            margin-top: 20px;
            color: #666;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="file"],
        input[type="number"],
        select,
        textarea {
            width: calc(100% - 20px);
            padding: 8px 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        .required {
            color: red;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 10px 0 0;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="reset"] {
            background-color: #6c757d;
        }

        button:hover {
            background-color: #0056b3;
        }

        button[type="reset"]:hover {
            background-color: #5a6268;
        }

        .radio-container {
            display: inline-block;
            margin-right: 20px; /* Adjust as needed */
        }

        .radio-buttons-container label {
            display: inline-block;
            margin-right: 20px;
        }

        .checkbox-container {
            display: inline-block; /* Display the containers inline */
            margin-right: 20px; /* Add some space between containers */
        }

        .checkbox-container label {
            margin-right: 5px; /* Add some space between label and checkbox */
        }

        /* Define a class for the radio button container */
        .radio-group {
            display: flex; /* Use flexbox to align items horizontally */
            align-items: center; /* Align items vertically in the center */
        }

        /* Style individual radio button and label */
        .radio-group input[type="radio"] {
            margin-right: 10px; /* Adjust the spacing between radio buttons and labels */
        }

        .radio-group label {
            margin-right: 20px; /* Adjust the spacing between labels */
        }

        .formContainer {
            user-select:auto;
            padding-top: 50px;
        }

    </style>
</head>
<body>
        
    
    <div class="header">
        <div class="header-title">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuLifS3m4B3SBF0SzDMGS0aT1Ae_SwK80AMw&s" alt="Election Commission of India Logo">
            <h1>भारत निर्वाचन आयोग / Election Commission of India</h1>
        </div>
        <div class="header-user">
            <img src="https://static.vecteezy.com/system/resources/previews/008/442/086/non_2x/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" alt="User Icon">
            <div>मतदाता सेवा पोर्टल / VOTERS' SERVICE PORTAL<br>Priya Rani Verma</div>
        </div>
    </div>
    
    <div class="sidebar">
	
    <h2>Form Particulars</h2>
    <a href="#sectionA" id="linkA">A. Select State, District & AC <span class="checkmark" id="checkA" >&#10003;</span></a>
    <a href="#sectionB" id="linkB">B. Personal Details <span class="checkmark" id="checkB" >&#10003;</span></a>
    <a href="#sectionC" id="linkC">C. Relatives Details <span class="checkmark" id="checkC" >&#10003;</span></a>
    <a href="#sectionD" id="linkD">D. Contact Details <span class="checkmark" id="checkD" >&#10003;</span></a>
    <a href="#sectionE" id="linkE">E. Aadhaar Details <span class="checkmark" id="checkE" >&#10003;</span></a>
    <a href="#sectionF" id="linkF">F. Gender <span class="checkmark" id="checkF" >&#10003;</span></a>
    <a href="#sectionG" id="linkG">G. Date of Birth details <span class="checkmark" id="checkG" >&#10003;</span></a>
    <a href="#sectionH" id="linkH">H. Present Address Details <span class="checkmark" id="checkH" >&#10003;</span></a>
    <a href="#sectionI" id="linkI">I. Disability <span class="checkmark" id="checkI" >&#10003;</span></a>
    <a href="#sectionJ" id="linkJ">J. Family Member <span class="checkmark" id="checkJ" >&#10003;</span></a>
    <a href="#sectionK" id="linkK">K. Declaration <span class="checkmark" id="checkK" >&#10003;</span></a>
    <a href="#sectionL" id="linkL">L. Security Questions <span class="checkmark" id="checkL">&#10003;</span></a>
</div>
    <container class="formContainer">	
<form id="voterRegistrationForm">
        <h1>Application Form for New Voters</h1>
	
        <section id="sectionA">
            <h2>A. Select State, District & Assembly/Parliamentary Constituency</h2>
            <label for="state">State <span class="required">*</span></label>
            <select class="form-select" name="stateCode" id="state" aria-label="State" required>
                <option value="">Select State</option>
                <?php foreach ($states as $state): ?>
					<option value="<?php echo $state['StateCode']; ?>"><?php echo $state['StateName']; ?></option>
				<?php endforeach; ?>
  
            </select>
            <span class="error-message" id="stateError">This field is required</span>
            
            <label for="district">District</label>
            <select id="district" name="district" required>
                <option value="">Select District</option>
                
            </select>
            
            
            <label for="assemblyConstituency">No. & Name of Assembly Constituency <span class="required">*</span></label>
			<select id="assemblyConstituency" name="assemblyConstituency" required>
				<option value="">Select Assembly Constituency</option>
				<option value="Kalwakurthy">Kalwakurthy</option>
				<option value="Shadnagar">Shadnagar</option>
				<option value="Ibrahimpatnam">Ibrahimpatnam</option>
				<option value="Lal Bahadur Nagar">Lal Bahadur Nagar</option>
				<option value="Maheswaram">Maheswaram</option>
				<option value="Rajendranagar">Rajendranagar</option>
				<option value="Serilingampally">Serilingampally</option>
				<option value="Chevella(SC)">Chevella(SC)</option>
				<!-- Add more constituencies from Rangareddy as needed -->
			</select>

        <p>I submit application for inclusion of my name in the electoral roll for the above constituency.</p>
            <div class="section-container" id="sectionA">
                <!-- Section A content here -->
                
              <button onclick="goToSection('sectionB', 'checkA')">Next</button>
			  </div>
        </section>
        
        <section id="sectionB">
            <h2>B. Personal Details</h2>
            <label for="firstName">First Name followed by Middle Name <span class="required">*</span></label>
            <input type="text" id="firstName" name="firstName" value="" required>
            
            <label for="surname">Surname (if any)</label>
            <input type="text" id="surname" name="surname" value="">
            
            <label for="photo">Upload Photograph <span class="required">*</span></label>
            <input type="file" id="photo" name="photo" accept=".jpg, .jpeg" required>

            <div class="section-container" id="sectionB">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionA')">Previous</button>
            <button onclick="goToSection('sectionC', 'checkB')">Next</button>
 
            </div>
        </section>
        
        <section id="sectionC">
            <h2>C. Name and Surname of any one of the relatives</h2>
            <label for="relationship">Relatives <span class="required">*</span></label><br>

            <div class="radio-group">
                <label>
                    <input type="radio" id="father" name="relationship" value="father" checked>
                    Father
                </label>
        
                <label>
                    <input type="radio" id="mother" name="relationship" value="mother">
                    Mother
                </label>
        
                <label>
                    <input type="radio" id="husband" name="relationship" value="husband">
                    Husband
                </label>
        
                <label>
                    <input type="radio" id="wife" name="relationship" value="wife">
                    Wife
                </label>
        
                <label>
                    <input type="radio" id="guardian" name="relationship" value="guardian">
                    Legal Guardian in case of orphan/Third Gender
                </label>
            </div>

            <label for="relativeName">Name <span class="required">*</span></label>
            <input type="text" id="relativeName" name="relativeName"  required>
            
            <label for="relativeSurname">Surname</label>
            <input type="text" id="relativeSurname" name="relativeSurname">
            
            
            <div class="section-container" id="sectionC">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionB')">Previous</button>
            <button onclick="goToSection('sectionD', 'checkC')">Next</button>

            </div>
        </section>
        
        <section id="sectionD">
            <h2>D. Contact Details</h2>
            
            <div class="checkbox-container">
                <label for="selfMobile">Self</label>
                <input type="checkbox" id="selfMobile" name="selfMobile" onclick="handleCheckbox('selfMobile', 'relativeMobile')">
            </div>
            <div class="checkbox-container">
                <label for="relativeMobile">Relative mentioned above</label>
                <input type="checkbox" id="relativeMobile" name="relativeMobile" onclick="handleCheckbox('relativeMobile', 'selfMobile')">
            </div>
            
            
            <label for="mobile">Mobile Number</label>
            <input type="tel" id="mobile" name="mobile">

            
            <br>
            <div class="checkbox-container">
                <label for="selfEmail">Self</label>
                <input type="checkbox" id="selfEmail" name="selfEmail" onclick="handleCheckbox('selfEmail', 'relativeEmail')">
            </div>
            <div class="checkbox-container">
                <label for="relativeEmail">Relative mentioned above</label>
                <input type="checkbox" id="relativeEmail" name="relativeEmail" onclick="handleCheckbox('relativeEmail', 'selfEmail')">
            </div>
            <label for="email">Email ID</label>
            <input type="email" id="email" name="email">
            <br><br>
        
            <div class="section-container" id="sectionD">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionC')">Previous</button>
            <button onclick="goToSection('sectionE')">Next</button>
            </div>
        </section>
        
        
        
        <section id="sectionE">
            <h2>E. Aadhaar Details</h2>
                <div class="radio-group row">
                    <div class="col-md-auto">
                        <input type="radio" id="aadhaarNumber" name="aadhaarOption" value="yes" onclick="toggleAadhaarInput(true)">
                        <label for="aadhaarNumber">Aadhaar Number</label>
                    </div>
                    <div class="col-md-auto">
                        <input type="radio" id="noAadhaar" name="aadhaarOption" value="no" onclick="toggleAadhaarInput(false)">
                        <label for="noAadhaar">I am not able to furnish my Aadhaar Number because I don't have Aadhaar Number.</label>
                    </div>
                </div>
            </section>
            
        
        
            <label for="aadhaar" id="aadhaarLabel" style="display: none;">Aadhaar Number</label>
            <input type="text" id="aadhaar" name="aadhaar" placeholder="••••••••••••" style="display: none;">

            
        
            <div class="section-container" id="sectionE">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionD')">Previous</button>
            <button onclick="goToSection('sectionF', 'checkE')">Next</button>
			</div>
        </section>
        
        
        
        
        <section id="sectionF">
            <h2>F. Gender</h2>
            <div class="radio-group">
                <label>
                    <input type="radio" id="male" name="gender" value="male">
                    Male
                </label>
                <label>
                    <input type="radio" id="female" name="gender" value="female" checked>
                    Female
                </label>
                <label>
                    <input type="radio" id="thirdGender" name="gender" value="thirdGender">
                    Third Gender
                </label>
            </div>
            <div class="section-container" id="sectionF">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionE')">Previous</button>
            <button onclick="goToSection('sectionG', 'checkF')">Next</button>
			</div>
        </section>
        

        
        <section id="sectionG">
            <h2>G. Date of Birth details</h2>
            <label for="dob">7(.a) Date of Birth <span class="required">*</span></label>
            <input type="date" id="dob" name="dob" value="2003-06-16" required>
        
            <label for="dobProof">7(b.) Self attested copy of document supporting age proof attached<span class="required">*</span></label>
            <div class="radio-buttons-container">
                <label>
                    <input type="radio" id="dobProofRadio" name="dobProofRadio" value="dobProof" onclick="toggleDocumentInput(true)">
                    Document for proof of Date of Birth
                </label>
                <label for="ageproof"></label>
                <select class="form-select" name="ageproof" id="ageproof" aria-label="" disabled>
                    <option value="">Select Document</option>
                    <option value="BCMR">Birth Certificate issued by Competent Local Body/Municipal Authority/Registrar of Births & Deaths</option>
                    <option value="ADHR">Aadhaar Card</option>
                    <option value="PC">Pan Card</option>
                    <option value="DL">Driving License</option>
                    <option value="CCIS">Certificates of Class X or Class XII issued by CBSE/ICSE/ State Education Boards , if it contains Date of Birth</option>
                    <option value="IPSP">Indian Passport</option>
                </select>
                <label>
                    <input type="radio" id="otherProofRadio" name="dobProofRadio" value="otherProof" onclick="toggleDocumentInput(false)">
                    Any other Document for proof of Date of Birth (If no document is available) (Pl. Specify)
                </label>
            </div>
            <label for="otherDocument">Specify other document:</label>
            <input type="text" id="otherDocument" name="otherDocument">
        
            <label for="dobProof">Document for proof of Date of Birth (Document size maximum 2MB, .jpg, .png, .pdf) <span class="required">*</span></label>
            <input type="file" id="dobProof" name="dobProof" accept=".jpg, .png, .pdf" required>
        
            <div class="section-container" id="sectionG">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionF')">Previous</button>
            <button onclick="goToSection('sectionH', 'checkG')">Next</button>
			</div>
        </section>

        <section id="sectionH">
            <h2>H. Present Address Details</h2>
            <label for="presentAddress">8(a.) Present Ordinary Residence (Full Address)</label>
            <div class="address-details">
                <div class="address-field">
                    <label for="houseNo">House/Building/Apartment No *</label>
                    <input type="text" id="houseNo" name="houseNo" required>
                </div>
                <div class="address-field">
                    <label for="street">Street/Area/Locality/Mohalla/Road *</label>
                    <input type="text" id="street" name="street" required>
                </div>
                <div class="address-field">
                    <label for="village">Village/Town *</label>
                    <input type="text" id="village" name="village" required>
                </div>
                <div class="address-field">
                    <label for="postOffice">Post Office *</label>
                    <input type="text" id="postOffice" name="postOffice" required>
                </div>
                <div class="address-field">
                    <label for="pinCode">PIN Code *</label>
                    <input type="text" id="pinCode" name="pinCode" required>
                </div>
                <div class="address-field">
                    <label for="tehsil">Tehsil/Taluqa/Mandal *</label>
                    <input type="text" id="tehsil" name="tehsil" required>
                </div>
                <div class="address-field">
                    <label for="district">District *</label>
                    <input type="text" id="district" name="district" required>
                </div>
                <div class="address-field">
                    <label for="state">State/UT *</label>
                    <input type="text" id="state" name="state" required>
                </div>
            </div>
            <label for="proofOfResidence">8(b.) Self-attested copy of address proof either in the name of applicant or any one of parents/spouse/adult child, if already enrolled as elector at the same address (Attach anyone of them)</label>
            <div class="radio-buttons-container">
                

                <div class="radio-buttons-container">
                    <label>
                        <input type="radio" id="aadhaarProof" name="proofOfResidence" value="aadhaar" onclick="toggleResidenceProofInput(true)">
                        Document for Proof of Residence - Aadhaar Card
                    </label>
                    <!-- Dropdown for selecting document type for Aadhaar Card -->
                    <select class="form-select" name="currentAddressProofType" aria-label="" disabled="">
                        <option value="">Select Document</option>
                        <option value="WEGB">Water/Electricity/Gas connection Bill for that address (at least 1 year)</option>
                        <option value="ADHR">Aadhaar Card</option>
                        <option value="CPNS">Current passbook of Nationalized/Scheduled Bank/Post Office</option>
                        <option value="IPSP">Indian Passport</option>
                        <option value="RDLR">Revenue Department's Land Owning records including Kisan Bahi</option>
                        <option value="RRLD">Registered Rent Lease Deed (In case of tenant)</option>
                        <option value="RSD">Registered Sale Deed (In case of own house)</option>
                    </select>
                    <label>
                        <input type="radio" id="otherProof" name="proofOfResidence" value="other" onclick="toggleResidenceProofInput(false)">
                        Any other document for Proof of Residence (If no document is available) (Pl. Specify)
                    </label>
                </div>
                <!-- Text box for specifying other document -->
                <input type="text" id="otherResidenceProof" name="otherResidenceProof" placeholder="Specify other document" disabled="">
                <label for="residenceProofFile">Proof of Residence (Document size maximum 2MB, .jpg, .png, .pdf) *</label>
                <input type="file" id="residenceProofFile" name="residenceProofFile" accept=".jpg, .png, .pdf" required>
            
                <div class="section-container" id="sectionH">
                    <!-- Section A content here -->
                    <button onclick="goToSection('sectionG')">Previous</button>
                <button onclick="goToSection('sectionI', 'checkH')">Next</button>
			</div>
            </div>
        </section>
        
        <section id="sectionI">
            <h2>I. Category</h2>
            <label for="hasDisability">Do you have a disability?</label>
            <input type="checkbox" id="hasDisability" onchange="toggleDisabilityFields()">
        
            <div id="disabilityFields" style="display: none;">
                <label for="disabilityType">Disability Type</label>
                <div class="checkbox-container">
                    <div>
                        <input type="checkbox" id="locomotive" name="disabilityType" value="locomotive">
                        <label for="locomotive">Locomotive</label>
                    </div>
                    <div>
                        <input type="checkbox" id="visual" name="disabilityType" value="visual">
                        <label for="visual">Visual</label>
                    </div>
                    <div>
                        <input type="checkbox" id="deafDumb" name="disabilityType" value="deafDumb">
                        <label for="deafDumb">Deaf & Dumb</label>
                    </div>
                    <div>
                        <input type="checkbox" id="otherDisability" name="disabilityType" value="otherDisability">
                        <label for="otherDisability">Other Disability</label>
                    </div>
                </div>
        
                <label for="percentageDisability">Percentage of Disability</label>
                <input type="number" id="percentageDisability" name="percentageDisability" min="0" max="100" placeholder="%">
        
                <label for="certificateAttached">Certificate Attached</label>
                <div class="radio-buttons-container">
                    <label>
                        <input type="radio" id="certificateYes" name="certificateAttached" value="yes">
                        Yes
                    </label>
                    <label>
                        <input type="radio" id="certificateNo" name="certificateAttached" value="no">
                        No
                    </label>
                </div>
        
                <label for="disabilityCertificate">Disability Certificate (Document size maximum 2MB, .jpg, .png, .pdf) *</label>
                <input type="file" id="disabilityCertificate" name="disabilityCertificate" accept=".jpg, .png, .pdf" required>
            </div>
        
            <div class="section-container">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionH')">Previous</button>
                <button onclick="goToSection('sectionJ', 'checkI')">Next</button>
			</div>
        </section>
        
        
        <section id="sectionJ">
            <h2>J. The details of my family member already included in the electoral roll at current address with whom I currently reside are as under</h2>
            <label for="section J">10. Family Member</label>
            <label for="familyMemberName">Name of Family Member</label>
            <input type="text" id="familyMemberName" name="familyMemberName">
        
            <label for="relationship">Relationship with applicant</label>
            <select id="relationships" name="relationships">
                <option value="">Select Relation</option>
                <option value="father">Father</option>
                <option value="mother">Mother</option>
                <option value="husband">Husband</option>
                <option value="guardian">Legal Guardian in case of orphan/Gur incase of third gender</option>
            </select>
        
            <label for="epicNumber">His/Her EPIC Number</label>
            <input type="text" id="epicNumber" name="epicNumber">

            <div class="section-container" id="sectionJ">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionI')">Previous</button>
                <button onclick="goToSection('sectionK', 'checkJ')">Next</button>
			</div>
        </section>
        
        
        <section id="sectionK">
            <h2>K. Declaration</h2>
            <p>
                I Hereby declare that to the best of My knowledge and belief.
            </p>
            
            <ol>
                <li>
                    I am a citizen of India and place of my birth is
                    <br>
                    <label for="birthVillageTown">Village/Town *</label>
                    <input type="text" id="birthVillageTown" name="birthVillageTown">
                    <br>
                    <label for="birthState">State/UT *</label>
            <select id="birthState" name="birthState">
				<!-- Options for State/UT dropdown -->
				<option value="">Select State/UT</option>
				<option value="Telangana">Telangana</option>
				<option value="Andaman & Nicobar Islands">Andaman & Nicobar Islands</option>
				<option value="Andhra Pradesh">Andhra Pradesh</option>
				<option value="Arunachal Pradesh">Arunachal Pradesh</option>
				<option value="Assam">Assam</option>
				<option value="Bihar">Bihar</option>
				<option value="Chandigarh">Chandigarh</option>
				<option value="Chattisgarh">Chattisgarh</option>
				<option value="Dadra & Nagar Haveli and Daman & Diu">Dadra & Nagar Haveli and Daman & Diu</option>
				<option value="Goa">Goa</option>
				<option value="Gujarat">Gujarat</option>
				<option value="Haryana">Haryana</option>
				<option value="Himachal Pradesh">Himachal Pradesh</option>
				<option value="Jammu and Kashmir">Jammu and Kashmir</option>
				<option value="Jharkhand">Jharkhand</option>
				<option value="Karnataka">Karnataka</option>
				<option value="Kerala">Kerala</option>
				<option value="Ladakh">Ladakh</option>
				<option value="Lakshadweep">Lakshadweep</option>
				<!-- Add more options as needed -->
			</select>
            <br>
            <label for="birthDistrict">District</label>
            <select id="birthDistrict" name="birthDistrict">
                <!-- Options for District dropdown -->
                    <option value="">Select District</option>
					<option value="Medak">Medak</option>
					<option value="Medchal Malkajgiri">Medchal Malkajgiri</option>
					<option value="Mulugu">Mulugu</option>
					<option value="Nagarkurnool">Nagarkurnool</option>
					<option value="Nalgonda">Nalgonda</option>
					<option value="Narayanpet">Narayanpet</option>
					<option value="Nirmal">Nirmal</option>
					<option value="Nizamabad">Nizamabad</option>
					<option value="Peddapalli">Peddapalli</option>
					<option value="Rajanna Sircilla">Rajanna Sircilla</option>
					<option value="Rangareddy">Rangareddy</option>
            </select>
			</li>

                <li>
                    I am ordinarily a resident at the address mentioned at Section 8(a) in Form 6 since*
                    <br>
                    Selected month: <input type="month" id="residenceMonth" name="residenceMonth">
                </li>
                <li>
                    I am applying for inclusion in Electoral Roll for the first time and my name is not included in any Assembly Constituency/Parliamentary Constituency.
                </li>
                <li>
                    I don’t possess any of the mentioned documents for proof of Date of Birth/Age. Therefore, I have enclosed, below mentioned document in support of age proof. (Leave blank, if not applicable).
                    <input type="text" id="ageProofDocument" name="ageProofDocument" placeholder="Enter document name">
                </li>
                <li>
                    I am aware that making the above statement or declaration in relation to this application which is false and which I know or believe to be false or do not believe to be true, is punishable under Section 31 of Representation of the People Act,1950 (43 of 1950) with imprisonment for a term which may extend to one year or with fine or with both.
                <br>
                    Place*
                    <input type="text" id="declarationPlace" name="declarationPlace">
                    <br>
                    Date
                    <input type="date" id="declarationDate" name="declarationDate">
                </li>
            </ol>
            <div class="section-container" id="sectionK">
                <!-- Section A content here -->
                <button onclick="goToSection('sectionJ')">Previous</button>
                <button onclick="goToSection('sectionL', 'checkK')">Next</button>
			</div>
        </section>
        

        <section id="sectionL">
            <h2>L. Security Questions</h2>
            
            <div>
                <label for="securityQuestion1">What is the name of the first school you attended?</label>
                <input type="text" id="securityQuestion1" name="securityQuestion1" required>
            </div>
            
            <div>
                <label for="securityQuestion2">What is the name of your childhood best friend?</label>
                <input type="text" id="securityQuestion2" name="securityQuestion2" required>
            </div>
            
            <div>
                <label for="securityQuestion3">What is the name of your favorite movie?</label>
                <input type="text" id="securityQuestion3" name="securityQuestion3" required>
            </div>
        
            <div class="section-container" id="sectionA">
                <!-- Section A content here -->
                <button type="button" onclick="showSection('sectionK')" class="section-buttons">Previous &#8592;</button>
                
            </div>
        </section>
        
        <div>
            <button type="button" onclick="previewAndSubmit()">Preview and Submit</button>
            <button type="button" onclick="saveForm()">Save</button>
            <button type="button" onclick="cancelForm()">Cancel</button>
        </div>
		</form>
</container>
        <script>
            // Function to show the specified section
            function showSection(sectionId) {
                // Your existing showSection function logic here
            }
    
            // Function to check if all required fields in the current section are filled
            function checkRequiredFields(sectionId) {
    var section = document.getElementById(sectionId);
    var requiredFields = section.querySelectorAll('.required');
    var allFilled = true;

    requiredFields.forEach(function(field) {
        if (field.nodeName === 'INPUT' || field.nodeName === 'SELECT' || field.nodeName === 'TEXTAREA') {
            if (!field.value.trim() || field.value === '') {
                allFilled = false;
                // Display error message
                var errorMessage = document.createElement('span');
                errorMessage.className = 'error-message';
                errorMessage.textContent = 'This field is required';
                errorMessage.style.color = 'red';
                // Check if error message already exists
                var existingErrorMessage = field.parentNode.querySelector('.error-message');
                if (!existingErrorMessage) {
                    field.parentNode.appendChild(errorMessage);
                }
            } else {
                // Remove error message if field is filled
                var existingErrorMessage = field.parentNode.querySelector('.error-message');
                if (existingErrorMessage) {
                    field.parentNode.removeChild(existingErrorMessage);
                }
            }
        }
    });
    return allFilled;
}

    
            // Function to handle the button state based on required fields
            function handleButtonState(sectionId) {
                var nextButton = document.querySelector(`#${sectionId} button`);
                if (nextButton) {
                    nextButton.disabled = !checkRequiredFields(sectionId);
                }
            }
    
            // Add event listeners to input, select, and textarea elements in each section
            document.querySelectorAll('input, select, textarea').forEach(function(element) {
                element.addEventListener('input', function() {
                    var sectionId = this.closest('section').id;
                    handleButtonState(sectionId);
                });
            });
    
            // Initial button state check when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('section').forEach(function(section) {
                    handleButtonState(section.id);
                });
            });
        </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var relationshipSelect = document.getElementById('relationship');
        var relationshipOptions = ["Select","Father", "Mother", "Husband", "Wife", "Legal Guardian"];

        relationshipOptions.forEach(function(option) {
            var optionElement = document.createElement('option');
            optionElement.value = option.toLowerCase();
            optionElement.textContent = option;
            relationshipSelect.appendChild(optionElement);
        });
    });
    </script>

<script>
    // Function to show the specified section
    function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('form > section').forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            document.getElementById(sectionId).style.display = 'block';
        }

    // Function to check if all required fields in the current section are filled
    function checkRequiredFields(sectionId) {
        var section = document.getElementById(sectionId);
        var requiredFields = section.querySelectorAll('.required');
        var allFilled = true;

        requiredFields.forEach(function(field) {
            if (field.nodeName === 'INPUT' || field.nodeName === 'SELECT' || field.nodeName === 'TEXTAREA') {
                if (!field.value.trim() || field.value === '') {
                    allFilled = false;
                    // Display error message
                    var errorMessage = document.createElement('span');
                    errorMessage.className = 'error-message';
                    errorMessage.textContent = 'This field is required';
                    errorMessage.style.color = 'red';
                    // Check if error message already exists
                    var existingErrorMessage = field.parentNode.querySelector('.error-message');
                    if (!existingErrorMessage) {
                        field.parentNode.appendChild(errorMessage);
                    }
                } else {
                    // Remove error message if field is filled
                    var existingErrorMessage = field.parentNode.querySelector('.error-message');
                    if (existingErrorMessage) {
                        field.parentNode.removeChild(existingErrorMessage);
                    }
                }
            }
        });
        return allFilled;
    }

    // Function to handle the button state based on required fields
    function handleButtonState(sectionId) {
        var nextButton = document.querySelector(`#${sectionId} button`);
        if (nextButton) {
            nextButton.disabled = !checkRequiredFields(sectionId);
        }
    }

    // Add event listeners to input, select, and textarea elements in each section
    document.querySelectorAll('input, select, textarea').forEach(function(element) {
        element.addEventListener('input', function() {
            var sectionId = this.closest('section').id;
            handleButtonState(sectionId);
        });
    });

    // Initial button state check when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('section').forEach(function(section) {
            handleButtonState(section.id);
        });
    });

    function handleCheckbox(clickedCheckboxId, otherCheckboxId) {
    var clickedCheckbox = document.getElementById(clickedCheckboxId);
    var otherCheckbox = document.getElementById(otherCheckboxId);

    if (clickedCheckbox.checked) {
        otherCheckbox.checked = false;
    }
}

function toggleAadhaarInput(hasAadhaar) {
    var aadhaarInput = document.getElementById('aadhaar');
    var aadhaarLabel = document.getElementById('aadhaarLabel');

    if (hasAadhaar) {
        aadhaarInput.style.display = 'block';
        aadhaarLabel.style.display = 'block';
    } else {
        aadhaarInput.style.display = 'none';
        aadhaarLabel.style.display = 'none';
    }
}

</script>

<script>
    function toggleDocumentInput(enable) {
        var ageproof = document.getElementById("ageproof");
        ageproof.disabled = !enable;
    }
</script>

<script>
    function toggleResidenceProofInput(enable) {
        var residenceProofFile = document.getElementById("residenceProofFile");
        residenceProofFile.disabled = !enable;
    }
</script>

<script>
    function toggleResidenceProofInput(enable) {
        var residenceProofFile = document.getElementById("residenceProofFile");
        var currentAddressProofType = document.getElementsByName("currentAddressProofType")[0];
        var otherResidenceProof = document.getElementById("otherResidenceProof");

        residenceProofFile.disabled = !enable;
        currentAddressProofType.disabled = !enable;
        otherResidenceProof.disabled = enable;
    }
</script>

<script>
    function goToSection(sectionId) {
        document.getElementById(sectionId).scrollIntoView();
    }
</script>

<script>
    function toggleDisabilityFields() {
        var hasDisabilityCheckbox = document.getElementById("hasDisability");
        var disabilityFields = document.getElementById("disabilityFields");

        if (hasDisabilityCheckbox.checked) {
            disabilityFields.style.display = "block";
        } else {
            disabilityFields.style.display = "none";
        }
    }
</script>
<script>
    function updateSidebar(sectionId) {
        var sectionLink = document.querySelector('a[href="' + sectionId + '"]');
        if (sectionLink) {
            sectionLink.classList.add('completed');
            sectionLink.querySelector('.checkmark').innerHTML = '&#10003;';
        }
    }
</script>

<script>
    // Get a reference to the district select element
    const districtSelect = document.getElementById('district');

    // Function to fetch districts based on the selected state
    function fetchDistricts(stateCode) {
        // Make an AJAX request to fetch districts
        fetch(`fetch_districts.php?stateCode=${stateCode}`)
            .then(response => response.json())
            .then(data => {
                // Clear existing options
                districtSelect.innerHTML = '<option value="">Select District</option>';
                
                // Populate select element with fetched districts
                data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching districts:', error));
    }

    // Event listener to fetch districts when state is selected
    document.getElementById('state').addEventListener('change', function() {
        const selectedState = this.value;
        if (selectedState !== '') {
            fetchDistricts(selectedState);
        } else {
            // Reset district select if no state is selected
            districtSelect.innerHTML = '<option value="">Select District</option>';
        }
    });
	
	function fetchConstituencies(districtName) {
    // AJAX request to fetch constituencies
    $.ajax({
        url: 'fetch_constituencies.php',
        type: 'GET',
        data: { districtName: districtName },
        dataType: 'json',
        success: function(response) {
            // Clear previous options
            $('#constituency').empty();
            
            // Append new options
            if(response && response.length > 0) {
                response.forEach(function(constituency) {
                    $('#constituency').append('<option value="' + constituency + '">' + constituency + '</option>');
                });
            } else {
                $('#constituency').append('<option value="">No Constituencies Found</option>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching constituencies:', error);
        }
    });
}

</script>

   <script>
        function previewAndSubmit() {
            // Get form values
            var state = "Telangana" //document.getElementById("state").value;
            var assemblyConstituency =  "Serilingampally" // document.getElementById("assemblyConstituency").value;
            var firstName = "Priya Rani" //document.getElementById("firstName").value;
            var surname = "Verma" //document.getElementById("surname").value;
            var gender = "female" //document.querySelector('input[name="gender"]:checked').value;
            var mobileNo = "9876543210" // document.getElementById("mobileNo").value;
            var houseNo = "123" // document.getElementById("houseNo").value;
            var street = "Main Street" //document.getElementById("street").value;
            var village = "Madhapur" //document.getElementById("village").value;
            var postOffice = "Madhapur PO" //document.getElementById("postOffice").value;
            var pincode = "403001" //document.getElementById("pincode").value;

            // Display preview and confirmation popup
            var confirmationMessage = 'Submitted successfully! Your reference ID is MNO432109876.';
            alert(confirmationMessage);

            // Redirect to reference ID page
            window.location.href = "reference.html";
        }
    </script>
	
	
</body>
</html>       