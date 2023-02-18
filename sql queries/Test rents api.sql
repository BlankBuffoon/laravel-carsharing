select
rents.id,
rents.status,
vehicles.id,
vehicles.status,
vehicle_brands.name,
vehicle_models.name,
renters.first_name,
renters.middle_name,
rents.begin_datetime,
rents.end_datetime,
rents.rented_time,
vehicles.price_at_minute,
rents.total_price
from rents
join vehicles on rents.vehicle_id = vehicles.id
join vehicle_models on vehicles.vehicle_model_id = vehicle_models.id
join vehicle_brands on vehicle_models.vehicle_brand_id = vehicle_brands.id
join renters on rents.renter_id = renters.id
where rents.id = 303
order by vehicles.id
-- and total_price > 999999;