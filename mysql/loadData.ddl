use gadriwau;

-- User
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash)
VALUES
("Ross Geller", "weWereOnABreak", "1977-06-22", "ross.geller@friends.com", "abcd");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash)
VALUES
("Monica Geller", "turkeyChef", "1977-06-22", "monica.geller@friends.com", "abcd");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash)
VALUES
("Chandler Bing", "jobNotFound404", "1977-06-22", "chandler.bing@friends.com", "abcd");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash)
VALUES
("Joey Tribiani", "drakeRamoray", "1977-06-22", "joey.tribiani@friends.com", "abcd");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash)
VALUES
("Rachel Green", "fashionPassion", "1977-06-22", "rachel.green@friends.com", "abcd");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHashHash)
VALUES
("Pheobe Buffay", "smellyCats", "1977-06-22", "pheobe.buffay@friends.com", "abcd");

-- Parking Space
INSERT INTO parkingSpace (name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
VALUES
("Indigo", "well-lit, accessible", 10, 50, 43.2603029, -79.9214898, "https://ca.parkindigo.com/en/car-park/32-james-street-south", 12);
INSERT INTO parkingSpace (name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
VALUES
("UPark", "ATM available", 12, 60, 43.2603029, -79.9214898, "https://ca.parkindigo.com/en/car-park/32-james-street-south", 23);
INSERT INTO parkingSpace (name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
VALUES
("APark", "24/7 service", 14, 70, 43.2603029, -79.9214898, "https://ca.parkindigo.com/en/car-park/32-james-street-south", 13);
INSERT INTO parkingSpace (name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
VALUES
("EPark", "covered parking", 16, 80, 43.2603029, -79.9214898, "https://ca.parkindigo.com/en/car-park/32-james-street-south", 1);
INSERT INTO parkingSpace (name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
VALUES
("IPark", "valet service available", 18, 90, 43.2603029, -79.9214898, "https://ca.parkindigo.com/en/car-park/32-james-street-south", 2);
INSERT INTO parkingSpace (name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
VALUES
("OPark", "no height restrictions", 20, 100, 43.2603029, -79.9214898, "https://ca.parkindigo.com/en/car-park/32-james-street-south", 3);


-- Review
INSERT INTO review (parkingID, userID, review, rating)
VALUES
(6, 6, "clean and well-maintained", 4);
INSERT INTO review (parkingID, userID, review, rating)
VALUES
(5, 5, "dirty and sticky", 1);
INSERT INTO review (parkingID, userID, review, rating)
VALUES
(4, 5, "we booked our spot ahead of time and were very happy with the service", 5);
INSERT INTO review (parkingID, userID, review, rating)
VALUES
(3, 4, "rude attendant who made inappropriate comments", 2);
INSERT INTO review (parkingID, userID, review, rating)
VALUES
(2, 1, "very well connected to the city's main attractions", 5);
INSERT INTO review (parkingID, userID, review, rating)
VALUES
(1, 2, "narrow tunnels makes going around the lot very risky", 3);