use gadriwau;

-- User
--password: abcd
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
VALUES
("Ross Geller", "weWereOnABreak", "1977-06-22", "ross.geller@friends.com", "44CFAFBB7F02D981AA2110574F64E6CECEE62A95FC6A77AC2CC3714F4B477CD2", "JHzXQ1sUUn");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
VALUES
("Monica Geller", "turkeyChef", "1977-06-22", "monica.geller@friends.com", "3A14F3D90BC34471DC9F90F4C47773AF1B878F0574C953B42A2F986CE9D8FFA9", "Be81ejcSsP");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
VALUES
("Chandler Bing", "jobNotFound404", "1977-06-22", "chandler.bing@friends.com", "26505502D17D8A3C1A78197DADB8771F67D7367E9CD256C9418CF0384279AFDD", "8ocVnPpiV6");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
VALUES
("Joey Tribiani", "drakeRamoray", "1977-06-22", "joey.tribiani@friends.com", "C2CC39C76B269D1D2B19A69BADCCC3A13BCF4826000397B10A461F200D8C9D08", "WTYGiMuICg");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
VALUES
("Rachel Green", "fashionPassion", "1977-06-22", "rachel.green@friends.com", "41C95A7BE21FDCF8A02966CBD657C5393A1DB330CDFC40A4AE86D848067BA8BE", "x4AKGk6jXy");
INSERT INTO user(fullName, username, dateOfBirth, email, passwordHash, salt)
VALUES
("Pheobe Buffay", "smellyCats", "1977-06-22", "pheobe.buffay@friends.com", "776FB84325E2B9A76CF940C5397CB267C622547BE2EA2675A9EA207B2A150BAF", "q5MH7ZM2Xy");

-- Parking Space
INSERT INTO parkingSpace(name, description, hourlyRate, numberOfSpots, latitude, longitude, website, paymentOptions)
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
(5, 3, "dirty and stinky", 1);
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