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
find_intersects(node, depth) as (
  select a.around, depth from get_orbits a join (
      select around, count(*) from get_orbits group by around having count(*)>1
    ) b on a.around = b.around
  group by a.around
),
find_path_nodes(object) as (
  select around 
  from get_orbits
  where around not in (select node from find_intersects)
  union
  select node from (select node, min(depth) from find_intersects)
)
Select count(*)-1
from find_path_nodes