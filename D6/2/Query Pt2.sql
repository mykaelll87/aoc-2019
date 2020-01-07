With recursive get_orbits(object, around, depth) as (
  Select obj, around, 0
  from orbits
  where obj = "SAN" or obj = "YOU"
  union all
  Select get_orbits.object, orbits.around, get_orbits.depth + 1
  from orbits, get_orbits
  where orbits.obj = get_orbits.around
  order by object
),
find_intersect(object, depth) as (
    select a.around, min(a.depth) from get_orbits a join (
      select around, count(*) from get_orbits group by around having count(*)>1
    ) b on a.around = b.around
  where a.object = "YOU"
),
get_intersect_depths(depth) as (
  select get_orbits.depth from get_orbits, find_intersect where get_orbits.around = find_intersect.object 
),
reach_santa(somme) as (
  select sum(depth) from get_intersect_depths
)
Select *
from reach_santa
-- Group by nom
-- Select count(*) from count_orbits