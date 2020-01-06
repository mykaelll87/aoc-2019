drop table if EXISTS objects;
Create table objects (nom varchar(3) primary key);
drop table if exists orbits;
create TABLE orbits (
  obj varchar(3),
  around varchar(3),
  FOREIGN key (obj) REFERENCES objects(nom) on DELETE cascade on  UPDATE no action,
  FOREIGN key (around) REFERENCES objects(nom) on delete CASCADE on update no action
);