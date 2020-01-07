delete from objects;
insert into objects(nom) values ("COM"),("B"),("C"),("D"),("E"),("G"),("J"),("K");

delete from orbits;
insert into orbits(around, obj) values ("COM","B"),
("B","C"),
("C","D"),
("D","E"),
("E","F"),
("B","G"),
("G","H"),
("D","I"),
("E","J"),
("J","K"),
("K","L");

