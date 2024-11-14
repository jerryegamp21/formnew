<?php
// Enable error reporting

// Database connection
$conn = new mysqli('127.0.0.1', 'root', '', 'form');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the insert statement
$stmt = $conn->prepare("INSERT INTO registrations (name, age, sex, status, date_of_birth, place_of_birth, home_address, occupation, religion, contact_no, pantawid, family_member_name, family_relationship, family_age, family_birthday, family_occupation, education_level, community_involvement, seminar_title, seminar_date, seminar_organizer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)");

// Bind parameters
$stmt->bind_param("sissssssssississsssss", $name, $age, $sex, $status, $date_of_birth, $place_of_birth, $home_address, $occupation, $religion, $contact_no, $pantawid, $family_member_name, $family_relationship, $family_age, $family_birthday, $family_occupation, $education_level, $community_involvement, $seminar_title, $seminar_date, $seminar_organizer);

// Set parameters from POST data
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$status = $_POST['status'];
$date_of_birth = $_POST['date_of_birth'];
$place_of_birth = $_POST['place_of_birth'];
$home_address = $_POST['home_address'];
$occupation = $_POST['occupation'];
$religion = $_POST['religion'];
$contact_no = $_POST['contact_no'];

// Assuming you want to insert the first family member's data
$pantawid = isset($_POST['pantawid']) ? $_POST['pantawid'] : '';
$family_member_name = is_array($_POST['family_name']) ? implode(", ", $_POST['family_name']) : $_POST['family_name'];
$family_relationship = is_array($_POST['family_relationship']) ? implode(", ", $_POST['family_relationship']) : $_POST['family_relationship'];
$family_age = is_array($_POST['family_age']) ? implode(", ", $_POST['family_age']) : $_POST['family_age'];
$family_birthday = is_array($_POST['family_birthday']) ? implode(", ", $_POST['family_birthday']) : $_POST['family_birthday'];
$family_occupation = is_array($_POST['family_occupation']) ? implode(", ", $_POST['family_occupation']) : $_POST['family_occupation'];

// Assuming you want to save the first educational attainment
$elementary= $_POST['elementary'];
$high_school= $_POST['high_school'];
$vocational= $_POST['vocational'];
$college = $_POST['college'];
$others= $_POST['others'];

$school= $_POST['school'];
$civic= $_POST['civic'];
$community= $_POST['community'];
$workspace= $_POST['workspace'];

$seminar_title = is_array($_POST['seminar_title']) ? implode(", ", $_POST['seminar_title']) : $_POST['seminar_title'];
$seminar_date = is_array($_POST['seminar_date']) ? implode(", ", $_POST['seminar_date']) : $_POST['seminar_date'];
$seminar_organizer = is_array($_POST['seminar_organizer']) ? implode(", ", $_POST['seminar_organizer']) : $_POST['seminar_organizer'];

// Execute the insert
if ($stmt->execute()) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Summary</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">Registration Summary</h1>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Identifying Data</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Name</th><td><?php echo htmlspecialchars($_POST['name']); ?></td></tr>
                    <tr><th>Age</th><td><?php echo htmlspecialchars($age); ?></td></tr>
                    <tr><th>Sex</th><td><?php echo htmlspecialchars($_POST['sex']); ?></td></tr>
                    <tr><th>Status</th><td><?php echo htmlspecialchars($_POST['status']); ?></td></tr>
                    <tr><th>Date of Birth</th><td><?php echo htmlspecialchars($_POST['date_of_birth']); ?></td></tr>
                    <tr><th>Place of Birth</th><td><?php echo htmlspecialchars($_POST['place_of_birth']); ?></td></tr>
                    <tr><th>Home Address</th><td><?php echo htmlspecialchars($_POST['home_address']); ?></td></tr>
                    <tr><th>Occupation</th><td><?php echo htmlspecialchars($_POST['occupation']); ?></td></tr>
                    <tr><th>Religion</th><td><?php echo htmlspecialchars($_POST['religion']); ?></td></tr>
                    <tr><th>Contact No</th><td><?php echo htmlspecialchars($_POST['contact_no']); ?></td></tr>
                    <tr><th>Pantawid</th><td><?php echo htmlspecialchars($_POST['pantawid']); ?></td></tr>

                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">Family Composition</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Relationship</th>
                            <th>Age</th>
                            <th>Birthday</th>
                            <th>Occupation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_POST['family_name'] as $index => $familyName): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($familyName); ?></td>
                                <td><?php echo htmlspecialchars($_POST['family_relationship'][$index]); ?></td>
                                <td><?php echo htmlspecialchars($_POST['family_age'][$index]); ?></td>
                                <td><?php echo htmlspecialchars($_POST['family_birthday'][$index]); ?></td>
                                <td><?php echo htmlspecialchars($_POST['family_occupation'][$index]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-info text-white">Educational Attainment</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Elementary</th><td><?php echo htmlspecialchars($_POST['elementary']); ?></td></tr>
                    <tr><th>High School</th><td><?php echo htmlspecialchars($_POST['high_school']); ?></td></tr>
                    <tr><th>Vocational</th><td><?php echo htmlspecialchars($_POST['vocational']); ?></td></tr>
                    <tr><th>College</th><td><?php echo htmlspecialchars($_POST['college']); ?></td></tr>
                    <tr><th>Others</th><td><?php echo htmlspecialchars($_POST['others']); ?></td></tr>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-warning text-white">Community Involvement</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>School</th><td><?php echo htmlspecialchars($_POST['school']); ?></td></tr>
                    <tr><th>Civic</th><td><?php echo htmlspecialchars($_POST['civic']); ?></td></tr>
                    <tr><th>Community</th><td><?php echo htmlspecialchars($_POST['community']); ?></td></tr>
                    <tr><th>Workspace</th><td><?php echo htmlspecialchars($_POST['workspace']); ?></td></tr>
                </table>
            </div>
        </div>

        <div class="card mb-4">
    <div class="card-header bg-secondary text-white">Seminars and Trainings</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Organizer</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_POST['seminar_title'])): ?>
                    <?php foreach ($_POST['seminar_title'] as $index => $seminarTitle): ?>
                        <tr>
                            <td><input type="text" name="seminar_title[]" value="<?php echo htmlspecialchars($seminarTitle); ?>" class="form-control" /></td>
                            <td><input type="date" name="seminar_date[]" value="<?php echo htmlspecialchars($_POST['seminar_date'][$index]); ?>" class="form-control" /></td>
                            <td><input type="text" name="seminar_organizer[]" value="<?php echo htmlspecialchars($_POST['seminar_organizer'][$index]); ?>" class="form-control" /></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">No seminars and trainings added.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Button to save data to database -->
        <form action="registered.php" method="POST">
            <?php foreach ($_POST as $key => $value): ?>
                <?php if (is_array($value)): ?>
                    <?php foreach ($value as $subValue): ?>
                        <input type="hidden" name="<?php echo htmlspecialchars($key); ?>[]" value="<?php echo htmlspecialchars($subValue); ?>">
                    <?php endforeach; ?>
                <?php else: ?>
                    <input type="hidden" name="<?php echo htmlspecialchars($key); ?>" value="<?php echo htmlspecialchars($value); ?>">
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" name="save_to_database" class="btn btn-primary">Save to Database</button>
        </form>
    </div>
</body>
</html>
