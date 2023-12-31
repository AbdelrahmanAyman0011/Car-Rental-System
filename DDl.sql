CREATE TABLE Customer (
    Customer_ID int PRIMARY KEY AUTO_INCREMENT,
    Fname char(55) not null,
    Lname char(55) not null,
    Gender char(1) not null,
    Country char(55) not null,
    City char(55) not null,
    Street char(55) not null,
    PhoneNum char(11) not null,
    Email char(55) not null UNIQUE,
    Password varchar(70) not null
);

CREATE TABLE Office (
    Office_ID int PRIMARY KEY AUTO_INCREMENT,
    Capacity int not null,
    Location varchar(50) not null
);

CREATE TABLE Car (
    Car_ID int PRIMARY KEY AUTO_INCREMENT,
    Plate_ID varchar(7),
    Car_Name char(55) not null,
    Model char(55) not null,
    Color char(55) not null,
    Price float not null,
    Office_ID int not null,
    State boolean DEFAULT true,
    FOREIGN KEY (Office_ID) REFERENCES Office(Office_ID)
);

CREATE TABLE Reserve (
    Customer_ID int not null,
    Car_ID int not null,
    S_Date date not null,
    En_Date date not null,
    PRIMARY KEY (Customer_ID, Car_ID, S_Date),
    FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID),
    FOREIGN KEY (Car_ID) REFERENCES Car(Car_ID)
);

CREATE TABLE Admin (
    Admin_ID int PRIMARY KEY,
    Fname varchar(55) not null,
    Lname varchar(55) not null,
    Gender char(1) not null,
    Email varchar(70) not null,
    Password varchar(70) not null,
    Office_ID int not null,
    FOREIGN KEY (Office_ID) REFERENCES Office(Office_ID)
);

CREATE TABLE Payment_Card (
    Card_ID varchar(20),
    CVV varchar(4),
    Ex_Date date not null,
    Password varchar(20),
    Customer_ID int not null,
    PRIMARY KEY (Card_ID, CVV),
    FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);

CREATE TABLE Payment_Operation (
    Operation_ID int,
    Date date,
    Card_ID varchar(25) not null,
    Customer_ID int not null,
    Price float not null,
    PRIMARY KEY (Operation_ID, Date),
    FOREIGN KEY (Card_ID) REFERENCES Payment_Card(Card_ID),
    FOREIGN KEY (Customer_ID) REFERENCES Customer(Customer_ID)
);