SELECT
bills.renters_count,
bills.type,
bills.id AS billID,
bills.status,
renters.id AS renterID,
renters.first_name
FROM bill_renter
JOIN renters ON renters.id = bill_renter.renter_id
JOIN bills ON bills.id = bill_renter.bill_id
WHERE bills.type = 'corporated'
ORDER BY renters.id