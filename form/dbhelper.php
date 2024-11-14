<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class dbhelper {
    private $conn;

    public function __construct() {
        // Database connection details
        $hostname = 'localhost';
        $dbname = 'form';
        $username = 'root';
        $password = '';

        try {
            // Create connection
            $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Log error to a file for security
            error_log("Connection failed: " . $e->getMessage(), 3, 'db_errors.log');
            die("Database connection error.");
        }
    }

    public function insertRegistration($data) {
        try {
            $this->conn->beginTransaction(); // Begin transaction
    
            $stmt = $this->conn->prepare("INSERT INTO registrations (name, age, sex, status, date_of_birth, place_of_birth, home_address, occupation, religion, contact_no, pantawid, elementary, high_school, vocational, college, others, school, civic, community, workspace, seminar_title, seminar_date, seminar_organizer) VALUES (:name, :age, :sex, :status, :date_of_birth, :place_of_birth, :home_address, :occupation, :religion, :contact_no, :pantawid, :elementary, :high_school, :vocational, :college, :others, :school, :civic, :community, :workspace, :seminar_title, :seminar_date, :seminar_organizer)");
            
            $stmt->execute($data);
            $registrationId = $this->conn->lastInsertId();
    
            $this->conn->commit(); // Commit transaction
            return $registrationId;
        } catch (PDOException $e) {
            $this->conn->rollBack(); // Rollback on failure
            error_log("Error inserting registration: " . $e->getMessage(), 3, 'db_errors.log');
            return false;
        }
    }
    
    public function insertFamilyMembers($registrationId, $familyDataArray) {
        try {
            $this->conn->beginTransaction(); // Begin transaction for family members
    
            $stmt = $this->conn->prepare("INSERT INTO family_members (registration_id, name, relationship, age, birthday, occupation) VALUES (:registration_id, :name, :relationship, :age, :birthday, :occupation)");
    
            foreach ($familyDataArray as $familyData) {
                $familyData['registration_id'] = $registrationId; // Set foreign key
                $stmt->execute($familyData);
            }
    
            $this->conn->commit(); // Commit transaction
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack(); // Rollback on failure
            error_log("Error inserting family member: " . $e->getMessage(), 3, 'db_errors.log');
            return false;
        }
    
    }

    public function __destruct() {
        // Close the connection
        $this->conn = null;
    }
}