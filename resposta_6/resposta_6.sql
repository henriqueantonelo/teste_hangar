SELECT DATE_FORMAT(ord.order_date, '%m/%Y') AS Data,
       SUM(ord.order_total) AS Soma	
FROM `user` usr
JOIN `orders` ord ON usr.user_id = ord.order_user_id
WHERE usr.user_id IN (1, 3, 5)
GROUP BY DATE_FORMAT(ord.order_date, '%m/%Y');
