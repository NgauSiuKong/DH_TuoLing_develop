select nl.class_id,class_title,class_oid,link_id,link_title,link_url,link_createtime
from ns_link nl 
left join ns_class ns 
on nl.class_id = ns.class_id
order by class_oid;



select class_id 
from ns_class 
where class_fid = 5 and class_status = 1 
order by class_oid desc;


select 
* 
from ns_link 
where class_id in ( select class_id 
                    from ns_class 
                    where class_fid = 5 and class_status = 1 
                    order by class_oid desc) order by class_id desc;


select nc.class_title,count(nl.link_id) from ns_link as nl left join ns_class as nc on nc.class_id = nl.class_id group by nc.class_id; 

select nc.class_title,count(nl.link_id) from ns_class as nc left join ns_link as nl on nl.class_id = nc.class_id group by nc.class_id;








select class_id from ns_link where link_id=26;
select class_fid from ns_class where class_id = (select class_id from ns_link where link_id=26);
select class_id,class_title from ns_class where class_fid = (select class_fid from ns_class where class_id = (select class_id from ns_link where link_id=26));

city(城市表)
    cidy_id
    city_name

user(用户表)
    city_id
    user_id
    user_name
    user_status 

查询含有会员的城市
    select city_id from user where user_status = 1 group by city_id;
                或者
    select distinct(city_id) from user where user_status = 1;
    

最后的结果(排除有会员的城市,就是完全没有会员的城市)
    select city_name from city where city_id not in ( select city_id from user where user_status = 1 group by city_id )
                或者
    select city_name from city where city_id not in ( select distinct(city_id) from user where user_status = 1 )



