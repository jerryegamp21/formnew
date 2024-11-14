CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT,
    sex ENUM('Male', 'Female', 'Other'),
    status ENUM('single', 'in a relationship', 'married', 'separated'),
    date_of_birth DATE,
    place_of_birth VARCHAR(255),
    home_address VARCHAR(255),
    occupation VARCHAR(255),
    religion VARCHAR(255),
    contact_no VARCHAR(15),
    pantawid ENUM('Yes', 'No'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE family (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_id INT,
    name VARCHAR(255) NOT NULL,
    relationship VARCHAR(255),
    age INT,
    birthday DATE,
    occupation VARCHAR(255),
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
);
CREATE TABLE educational_attainment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_id INT,
    elementary VARCHAR(255),
    high_school VARCHAR(255),
    vocational VARCHAR(255),
    college VARCHAR(255),
    others VARCHAR(255),
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
);
CREATE TABLE community_involvement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_id INT,
    school VARCHAR(255),
    civic VARCHAR(255),
    community VARCHAR(255),
    workspace VARCHAR(255),
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
);
CREATE TABLE seminars_trainings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration_id INT,
    title VARCHAR(255),
    date DATE,
    organizer VARCHAR(255),
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
);