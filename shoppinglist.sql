create database shoppinglist;

use shoppinglist;

create table item (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL,
    amount SMALLINT UNSIGNED NOT NULL
);

insert into item (description,amount) values ('Test item',1);

insert into item (description,amount) values ('Test item',5);

insert into item (description,amount) values ('Test item',33);

insert into item (description,amount) values ('Test item',4);

/*tätä kautta voisi lisätä testidataa suoraan tauluun jo luontivaiheessa*/