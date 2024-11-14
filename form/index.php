<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "dbhelper.php";
$_SESSION['form_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Empowerment and Reaffirmation of Paternal Abilities Registration Form</title>
</head>
<body class="bg-light">
<div class="container my-5 p-5 bg-white shadow rounded">
   <div class="d-flex justify-content-between mb-4">
        <img src="http://localhost/form/img/logo1.png" class="img-solid" style="max-height: 100px;">
        <h6 class="text-center mb-4">REPUBLIC OF THE PHILIPPINES<br>CITY OF CEBU<br>DEPARTMENT OF SOCIAL WELFARE AND SERVICES</h6>

        <img src="http://localhost/form/img/logo3.png" class="img-solid" style="max-height: 100px;">
    </div>

    <h1 class="text-center mb-4">Empowerment and Reaffirmation of Paternal Abilities Registration Form</h1>

    <form action="registered.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_SESSION['form_token']; ?>">

        <!-- Identifying Data -->
        <h4 class="mt-4">IDENTIFYING DATA</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" name="age">
            </div>
            <div class="col-md-6">
                <label for="sex" class="form-label">Sex:</label>
                <select class="form-select" name="sex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" name="status">
                    <option value="single">Single</option>
                    <option value="in a relationship">In a Relationship</option>
                    <option value="married">Married</option>
                    <option value="separated">Separated</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth">
            </div>
            <div class="col-md-6">
                <label for="place_of_birth" class="form-label">Place of Birth:</label>
                <input type="text" class="form-control" name="place_of_birth">
            </div>
            <div class="col-md-12">
                <label for="home_address" class="form-label">Home Address:</label>
                <input type="text" class="form-control" name="home_address">
            </div>
            <div class="col-md-6">
                <label for="occupation" class="form-label">Occupation:</label>
                <input type="text" class="form-control" name="occupation">
            </div>
            <div class="col-md-6">
                <label for="religion" class="form-label">Religion:</label>
                <input type="text" class="form-control" name="religion">
            </div>
            <div class="col-md-6">
                <label for="contact_no" class="form-label">Contact No:</label>
                <input type="number" class="form-control" name="contact_no">
            </div>
        </div>

        <!-- Family Composition -->
        <h4 class="mt-4">FAMILY COMPOSITION</h4>
        <div class="mb-3">
            <label class="form-label">Are you a 4Ps (Pantawid)?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pantawid" value="Yes" id="pantawidYes">
                <label class="form-check-label" for="pantawidYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pantawid" value="No" id="pantawidNo">
                <label class="form-check-label" for="pantawidNo">No</label>
            </div>
        </div>
        <table class="table table-bordered" id="familyTable">
            <thead class="table-light">
                <tr>
                    <th>Name/Wife/Children</th>
                    <th>Relationship</th>
                    <th>Age</th>
                    <th>Birthday</th>
                    <th>Occupation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" name="family_name[]"></td>
                    <td><input type="text" class="form-control" name="family_relationship[]"></td>
                    <td><input type="number" class="form-control" name="family_age[]"></td>
                    <td><input type="date" class="form-control" name="family_birthday[]"></td>
                    <td><input type="text" class="form-control" name="family_occupation[]"></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteFamilyMember(this)">Delete</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-secondary mb-4" onclick="addFamilyMember()">Add Member</button>

        <script>
            function addFamilyMember() {
                var table = document.getElementById("familyTable").getElementsByTagName('tbody')[0];
                var newRow = table.insertRow();
                newRow.innerHTML = `
                    <td><input type="text" class="form-control" name="family_name[]"></td>
                    <td><input type="text" class="form-control" name="family_relationship[]"></td>
                    <td><input type="number" class="form-control" name="family_age[]"></td>
                    <td><input type="date" class="form-control" name="family_birthday[]"></td>
                    <td><input type="text" class="form-control" name="family_occupation[]"></td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteFamilyMember(this)">Delete</button></td>
                `;
            }

            function deleteFamilyMember(button) {
                var row = button.closest('tr');
                row.remove();
            }
        </script>

        <!-- Educational Attainment -->
        <h4 class="mt-4">EDUCATIONAL ATTAINMENT</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="elementary" class="form-label">Elementary:</label>
                <input type="text" class="form-control" name="elementary">
            </div>
            <div class="col-md-6">
                <label for="high_school" class="form-label">High School:</label>
                <input type="text" class="form-control" name="high_school">
            </div>
            <div class="col-md-6">
                <label for="vocational" class="form-label">Vocational:</label>
                <input type="text" class="form-control" name="vocational">
            </div>
            <div class="col-md-6">
                <label for="college" class="form-label">College:</label>
                <input type="text" class="form-control" name="college">
            </div>
            <div class="col-md-12">
                <label for="others" class="form-label">Others:</label>
                <input type="text" class="form-control" name="others">
            </div>
        </div>

        <!-- Community Involvement -->
        <h4 class="mt-4">COMMUNITY INVOLVEMENT</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="school" class="form-label">School:</label>
                <input type="text" class="form-control" name="school">
            </div>
            <div class="col-md-6">
                <label for="civic" class="form-label">Civic:</label>
                <input type="text" class="form-control" name="civic">
            </div>
            <div class="col-md-6">
                <label for="community" class="form-label">Community:</label>
                <input type="text" class="form-control" name="community">
            </div>
            <div class="col-md-6">
                <label for="workspace" class="form-label">Workspace:</label>
                <input type="text" class="form-control" name="workspace">
            </div>
        </div>

      
        <!-- Seminars and Trainings -->
        <h4 class="mt-4">SEMINARS AND TRAININGS</h4>
    
    <table class="table table-bordered mt-4" id="seminarTable">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Organizer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="form-control" name="seminar_title[]"></td>
                <td><input type="date" class="form-control" name="seminar_date[]"></td>
                <td><input type="text" class="form-control" name="seminar_organizer[]"></td>
                <td><button type="button" class="btn btn-danger" onclick="deleteSeminar(this)">Delete</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary mb-4" onclick="addSeminar()">Add Seminar</button>
</div>

<script>
    function addSeminar() {
        var table = document.getElementById("seminarTable").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="seminar_title[]"></td>
            <td><input type="date" class="form-control" name="seminar_date[]"></td>
            <td><input type="text" class="form-control" name="seminar_organizer[]"></td>
            <td><button type="button" class="btn btn-danger" onclick="deleteSeminar(this)">Delete</button></td>
        `;
    }

    function deleteSeminar(button) {
        var row = button.closest('tr');
        row.remove();
    }
</script>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100" id="submitBtn">Submit Registration</button>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
