drop table Items;
drop table orderItems;
drop table Cart;
drop table Users;


create table Items(itemID int(5) not null auto_increment primary key, 
                   itemName char(255) not null unique, 
                   itemImage blob  not null,
                   price int(4) not null, 
                   description varchar(255), 
                   diet_type char(255));
                   
create table Users(userID int(5) not null auto_increment primary key, 
                   first_name char (255) not null,  
                   last_name char(255) not null, 
                   address varchar(7) not null,  
                   phonenumber int(10) not null,
                   email_address varchar(255) not null);


create table Cart(cartID int(5) not null auto_increment  primary key,
                  userID int(5) not null, 
                  created_on date not null,
                  address_to_deliver varchar(7) not null,
                 foreign key (userID) references Users(userID)) ;
                  
                  


 create table orderItems (orderItemId int(5) not null, 
                          cartNumber int(5), 
                          cartUserID int(5), 
                          quantity int(10),
                          deliveryDate date null,
                          foreign key (orderItemId) references Items(itemID),
                          foreign key (cartNumber) references Cart(cartID), 
                          foreign key (cartUserID) references Users(userID));
                          
                          
