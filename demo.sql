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