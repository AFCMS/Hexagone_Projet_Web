# Hexagone Projet Web

```shell
docker compose up
```

| Service    | URL                           |
|------------|-------------------------------|
| Apache     | http://127.0.0.1:8000         |
| MySQL      | mysql://127.0.0.1:6033/app_db |
| phpMyAdmin | http://127.0.0.1:8081         |

To display the database schema from phpMyAdmin, run the following SQL command:

```mysql
SHOW CREATE TABLE users;
```