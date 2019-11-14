
create table book(
                  bookID int(10),
                  title varchar(50),
                  author varchar(50),
                  category varchar(50),
                  type varchar(50), 
                  price int(10),
                  isbnNO bigint,
                  primary key(bookID)
                  );

insert into book values(12321,'the great gatsby','sccott fitzgerald','non-fiction','reserved',142,439027);                  
insert into book values(3209,'ulysses','james joyce','horror','non-reserved',523,532892);                  
insert into book values(2314,'1984','george orwell','romance','reserved',943,439027);                  
insert into book values(4321,'to the weekend','Virginia Woolf','romance','reserved',634,7592);                  
insert into book values(9643,'the american tragedy','theodore diaser','non-fiction','reserved',754,49128);                  
insert into book values(6534,'the invisible man','h.g. wells','non-fiction','reserved',462,89632);                  
insert into book values(5232,'animal farm','sccott fitzgerald','non-fiction','non-reserved',185,421948);                  
insert into book values(5235,'as i lay dying','william faulkner','non-fiction','reserved',235,51123);                  
insert into book values(49372,'howards end','E. Foster','roamance','reserved',286,59283);                  
insert into book values(83296,'deliverance','James Dickey','drama','non-reserved',865,52396);                  
insert into book values(58926,'the rainbow','Lawrence','horror','reserved',631,192836);                  
insert into book values(52389,'pale fire','vlamdir nabokov','tragedy','non-reserved',901,53227);                  


create table publisher(
                      publisherID int(10),
                      name varchar(50),
                      address varchar(50), 
                      website varchar(50),
                      primary key(publisherID)
                      );

insert into publisher values(312,'Golden Records','West Lance, Kyrat','golddden.12.com');
insert into publisher values(521,'Happy Co.','North P, Brick Fact','gwoign.12.com');
insert into publisher values(834,'Bridges Pub.','Jimes, Drive','gewoj342.com');
insert into publisher values(127,'Porter Pub.','Eastside Golon','598326few.com');
insert into publisher values(623,'Pagan In.','South Lane','e21ih12.com');

create table publishedby(
                         publishDate date, 
                         bookID int(10), 
                         publisherID int(10),
                         primary key(bookID,publisherID), 
                         foreign key(bookID) references book(bookID),
                         foreign key (publisherID) references publisher(publisherID)
                         );

insert into publishedby values('2005-12-06',12321,312);
insert into publishedby values('2015-11-06',3209,312);
insert into publishedby values('2013-02-06',2314,312);
insert into publishedby values('2009-12-06',4321,521);
insert into publishedby values('2002-02-06',9643,521);
insert into publishedby values('2014-12-06',6534,834);
insert into publishedby values('2003-02-06',5232,834);
insert into publishedby values('2002-12-06',49372,834);
insert into publishedby values('2001-02-06',83296,127);
insert into publishedby values('2001-12-06',58926,127);
insert into publishedby values('2001-02-06',52389,623);


create table librarymember(
                           email varchar(50),
                           password varchar(50),
                           firstname varchar(50),
                           lastname varchar(50),
                           dob date,
                           contactNO varchar(50),
                           rollNo varchar(50),
                           roomNo varchar(50),
                           fine bigint,
                           primary key (email)
                          );

INSERT INTO `librarymember` VALUES ('easyone@gmail.com','simplepass','easy','one','2000-05-14','','1701CS20','',0),
                                  ('paganin@gmail.com','Aa111111','Pagan','Min',NULL,NULL,'1701CS51',NULL,0),
                                  ('checkout@gmail.com','Aa111111','Check','Out',NULL,NULL,'1701CS51',NULL,0),
                                  ('ajayghale@gmail.com','Aa111111','Ajay','Ghale',NULL,NULL,'1701CS51',NULL,0),
                                  ('sambridges@gmail.com','Aa111111','Sam','Bridges',NULL,NULL,'1701CS51',NULL,0),
                                  ('vaibhavgajbhiye14@gmail.com','Aa111111','Vaibhav','Gajbhiye',NULL,NULL,'1701CS51',NULL,0);

create table issues(
                      email varchar(50),
                      bookID int(10),
                      issueDate date,
                      returnDate date,
                      primary key(email,bookID),
                      foreign key (email) references librarymember(email),
                      foreign key (bookID) references book(bookID)
                    );

insert into issues values('vaibhavgajbhiye14@gmail.com',12321,'2019-10-10','2019-11-10');                    
insert into issues values('vaibhavgajbhiye14@gmail.com',5232,'2019-10-10','2019-11-10');                    
insert into issues values('vaibhavgajbhiye14@gmail.com',5235,'2019-10-10','2019-11-10');                    
insert into issues values('ajayghale@gmail.com',49372,'2019-11-11','2019-12-11');                    
insert into issues values('sambridges@gmail.com',83296,'2019-10-10','2019-12-11');                    
insert into issues values('vaibhavgajbhiye14@gmail.com',52389,'2019-10-10','2019-12-10');                    


create table libraryadmin(
                           username varchar(50),
                           password varchar(50),
                           primary key(username)
                           );
