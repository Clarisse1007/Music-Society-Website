DROP SCHEMA IF EXISTS music;

CREATE SCHEMA music;

USE music;

CREATE TABLE event_feedback (
    feedback_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(30),         
    student_id VARCHAR(15),         
    program_of_study ENUM('DIT', 'DEM', 'BBA', 'BCS', 'BHC'),    
    overall_rating TINYINT,
    venue_setup ENUM('excellent', 'good', 'average', 'poor'),
    event_informativeness ENUM('yes', 'no'),
    attend_future ENUM('yes', 'no'),
    most_liked VARCHAR(100),
    improvements VARCHAR(100)
);

INSERT INTO event_feedback (student_name, student_id, program_of_study, overall_rating, venue_setup, event_informativeness, attend_future, most_liked, improvements) VALUES ('Alice Johnson', '24AMD15236', 'DIT', 8, 'Good', 'Yes', 'Yes', 'Great organization', 'More workshops');


CREATE TABLE add_event (
	event_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	event_title VARCHAR (100) NOT NULL,
	event_description VARCHAR (2000) NOT NULL,
	event_date_time VARCHAR (20) NOT NULL,
	event_location VARCHAR (20) NOT NULL,
        event_image VARCHAR (20) NOT NULL 
);


INSERT INTO add_event (event_title, event_description, event_date_time, event_location, event_image) VALUES 
('Audition', 'This event is for dancer having competition to join dancing society.This event only committee can watch,because dancing room too small cannot let too much people come in.Committe will choose a few dancer to become their dancing society dancer.Dancer must prepare above 2 minit dancing for one person.', '1/7/2024 20:00pm', 'Dancing Room', 'audition.png'),
('Showcase', 'This event will having once a sem,because this is for freshies try to dancing in our university.This will let many people know about dancing society.Dancer can make news friend at there during practice time.It can let dancer enjoy dancing in their school life.The helper can learn how to make the event and get experience.It is a small event so just having it at canteen.', '24/6/2024 20:30pm', 'Canteen', 'showcase.png'),
('Genz', 'This event happens once a year,because it is a big event for dancing society.This event is for who like to dancing to show their talents.It also for who like to watch dancing perform also can buy the genz ticket.This event have invite student Utar and Owl Dance Studio to come for perform.Other than that,it also have singing performance to make the event more interest.This event have almost have 20 performance to watch.They have pay the money for outside pa system to play the song and  projection mapping (3-D).The performance was very interest because got a new batch student perform with senior.', '25/5/2024 20:00pm', 'DSA Hall', 'genz.png');


CREATE TABLE users (
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(30) NOT NULL,
    address VARCHAR(60) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    status VARCHAR (2) NOT NULL
);

INSERT INTO users (name, email, address, phone_number, password, status) VALUES 
('Ali', 'member1@gmail.com', '123,jalan nanas', '012-6585559', '123', 'M'),
('admin1', 'admin@gmail.com', '456,jalan orange', '011-89576458',  '123', 'A'),
('Abu', 'abu@gmail.com', '124,jalan nanas', '011-98756842', '123', 'M'),
('Wong haha', 'wonghaha@gmail.com', '125,jalan emas', '013-8975125', '123', 'M'),
('Joey Chai', 'joey@gmail.com', '126,jalan orange', '016-1992354', '123', 'M');


CREATE TABLE event_booking (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(30),     
    student_id VARCHAR(15),
    program_of_study ENUM('DIT', 'DEM', 'BBA', 'BCS', 'BHC'), 
    row_selected ENUM('A', 'B', 'C', 'D', 'E'),    
    seat_selected INT NOT NULL,
    event_title VARCHAR (100) NOT NULL,
    booking_status VARCHAR(10) DEFAULT 'pending'
);

INSERT INTO event_booking (student_name, student_id, program_of_study, row_selected, seat_selected, event_title, booking_status) VALUES 
('Ali', '24ABC12345', 'DIT', 'A', 2, 'Genz', 'success'),
('Abu', '24ABC56845', 'DIT', 'B', 4, 'Showcase', 'success'),
('Ali', '24ABC12345', 'DIT', 'A', 3, 'Genz', 'success'),
('Wong haha', '24ABC18542', 'DEM', 'E', 10, 'Genz', 'success'),
('Joey Chai', '24ABC25741', 'BBA', 'A', 2, 'Audition', 'success');
