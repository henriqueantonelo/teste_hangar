SELECT usr.user_name AS Nome,
       usr.user_city AS Cidade,
       usr.user_country AS País,
       ord.order_date AS Data,
       ord.order_total AS Total
FROM `user` usr
JOIN `orders` ord ON usr.user_id = ord.order_user_id
WHERE usr.user_id IN (1, 3, 5)
ORDER BY usr.user_name;
