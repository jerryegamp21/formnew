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
    
    -- Family Composition (limiting to 3 family members as an example)
    family_name VARCHAR(255),
    family_relationship VARCHAR(255),
    family_age INT,
    family_birthday DATE,
    family_occupation VARCHAR(255),
    
  

    -- Educational Attainment
    elementary VARCHAR(255),
    high_school VARCHAR(255),
    vocational VARCHAR(255),
    college VARCHAR(255),
    others VARCHAR(255),

    -- Community Involvement
    school VARCHAR(255),
    civic VARCHAR(255),
    community VARCHAR(255),
    workspace VARCHAR(255),

    -- Seminars and Trainings (limiting to 3 seminars as an example)
    seminar_title VARCHAR(255),
    seminar_date DATE,
    seminar_organizer VARCHAR(255),

    

    -- Created timestamp
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
