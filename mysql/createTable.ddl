use gadriwau;

CREATE TABLE user (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    fullName VARCHAR(50) NOT NULL,
    username VARCHAR(64) NOT NULL,
    dateOfBirth date,
    email TEXT,
    passwordHash TINYTEXT NOT NULL,
    salt VARCHAR(64) NOT NULL,
    UNIQUE (username),
    CONSTRAINT pk_user PRIMARY KEY(id)
);

CREATE TABLE parkingSpace (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    hourlyRate DECIMAL(13,2) NOT NULL,
    numberOfSpots SMALLINT NOT NULL,
    latitude DECIMAL(10,8) NOT NULL,
    longitude DECIMAL(11,8) NOT NULL,
    website TEXT NOT NULL,
    paymentOptions SMALLINT NOT NULL,
    CONSTRAINT pk_parkingSpace PRIMARY KEY(id)
);

CREATE TABLE review (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    parkingID SMALLINT UNSIGNED NOT NULL,
    userID SMALLINT UNSIGNED NOT NULL,
    review TEXT,
    rating TINYINT NOT NULL,
    CONSTRAINT pk_review PRIMARY KEY(id),
    CONSTRAINT fk_reviewsParking FOREIGN KEY (parkingID) REFERENCES parkingSpace(id) ON DELETE CASCADE,
    CONSTRAINT fk_reviewUser FOREIGN KEY (userID) REFERENCES user(id) ON DELETE CASCADE
);