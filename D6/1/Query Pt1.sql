With recursive count_orbits(a,o) as (
  Select obj, around from orbits
  union all
  Select
    count_orbits.a, around
    from orbits, count_orbits
  where
    orbits.obj = o
)
-- Select
--   a as nom, count(o)
-- from count_orbits
-- Group by nom
Select count(*) from count_orbits