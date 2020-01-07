delete from objects;
insert into objects(nom)
values
  ("YOU"),("SAN"),("COM"),("B"),("C"),("D"),("E"),("G"),("J"),("K");

delete from orbits;
insert into orbits(around, obj)
values
  ("COM", "B"),
  ("B", "C"),
  ("C", "D"),
  ("D", "E"),
  ("E", "F"),
  ("B", "G"),
  ("G", "H"),
  ("D", "I"),
  ("E", "J"),
  ("J", "K"),
  ("K", "L"),
  ("K", "YOU"),
  ("I", "SAN");