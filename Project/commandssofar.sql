
create table book(bookID int(10),
                  title varchar(50),
                  author varchar(50),
                  category varchar(50),
                  type varchar(50), 
                  price int(10),
                  isbnNO bigint,
                  primary key(bookID));

insert into book values(1369,'misery','stephen king','horror','non-reserved',149.99,9331874556);
insert into book values(1429,'far from the madding crowd','tom hardy','romance','reserved',279.99,9549375234);
insert into book values(2020,'the great gatsby','scott fitzgeralt','action','non-reserved',149.99,59843745566);
insert into book values(1405,'hamlet','shakespeare','tragedy','non-reserved',639.99,639074453);
insert into book values(8992,'high for this','abel tesfaye','soul','non-reserved',10029.99,398242938693);
insert into book values(5002,'lord of the flies','william goulding','adventure','non-reserved',1009.99,54375394729);


create table publisher(publisherID int(10),
                      name varchar(50),
                      address varchar(50), 
                      website varchar(50),
                      primary key(publisherID));

create table publishedby(
   publishDate date, 
   bookID int(10), 
   publisherID int(10),
   primary key(bookID,publisherID), 
   foreign key(bookID) references book(bookID),
   foreign key (publisherID) references publisher(publisherID));

