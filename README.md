## rent sale products

### init

```
git clone git@github.com:dralexsand/rentsaleproducts.git
cd rentsaleproducts
./init.sh
```

### up

```
./up.sh
```

### down

```
./down.sh
```

### restart

```
./restart.sh
```

### migrate && seed

```
docker exec rent_rent_backend_php php artisan migrate
docker exec rent_rent_backend_php php artisan db:seed
```

### cron, checking the end of the lease term

```
docker exec rent_rent_backend_php php artisan schedule:work
```

### users

```
REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/users' \
--data ''

RESPONSE:
...
{
    "id": 5,
    "api_token": null,
    "name": "Jaylen Jacobi",
    "email": "uconsidine@example.net"
},
...

```

### login

```
select any user

REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/auth/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "uconsidine@example.net",
    "password": "password"
}'
 
RESPONSE:

{
    "id": 5,
    "api_token": "PNUnJvf3rUda3pFQVRRP5TCgjTOQaW4BL5eFaFulLKCIaxUsS0dzQKqfqn6K",
    "name": "Jaylen Jacobi",
    "email": "uconsidine@example.net",
    "email_verified_at": "2023-11-30T06:43:31.000000Z",
    "created_at": "2023-11-30T06:43:31.000000Z",
    "updated_at": "2023-11-30T06:49:52.000000Z"
}
 
```

### products

```
REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/products' \
--data ''

RESPONSE:

{
    "data": [
        {
            "id": 1,
            "title": "Schaefer LLC",
            "price": 59761,
            "rental_cost_per_hour": 60,
            "status": {
                "id": 1,
                "status": "accessible"
            },
            "code": "58eae295-746e-4502-9acc-51bc68e7c657"
        },
        {
            "id": 2,
            "title": "Schamberger Group",
            "price": 26426,
            "rental_cost_per_hour": 26,
            "status": {
                "id": 1,
                "status": "accessible"
            },
            "code": "ce1c8e17-c92a-40e3-8313-e60d0ce11387"
        },
        ...
        ]
}

```

### product_statuses

```
REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/product_statuses'

RESPONSE:
{
    "data": [
        {
            "id": 1,
            "status": "accessible"
        },
        {
            "id": 2,
            "status": "sold"
        },
        {
            "id": 3,
            "status": "leased"
        }
    ]
}
...

```

### rental_periods

```
REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/rental_periods'

RESPONSE:
{
    "data": [
        {
            "id": 1,
            "period": 4
        },
        {
            "id": 2,
            "period": 8
        },
        {
            "id": 3,
            "period": 12
        },
        {
            "id": 4,
            "period": 24
        }
    ]
}
...

```

### sale

```
REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/sale' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer PNUnJvf3rUda3pFQVRRP5TCgjTOQaW4BL5eFaFulLKCIaxUsS0dzQKqfqn6K' \
--data '{
    "product_id": 7
}'

RESPONSE:

{
    "data": {
        "id": 1,
        "user": {
            "id": 5,
            "name": "Jaylen Jacobi",
            "email": "uconsidine@example.net"
        },
        "product": {
            "id": 7,
            "title": "Ondricka-Kub",
            "price": 17334,
            "status": "sold",
            "code": "3ba11c84-3a03-49dd-84a2-8747235f38f3"
        },
        "sales_date": "2023-11-30 06:56:22"
    }
}
...

```

### rent

```
REQUEST:

curl --location 'http://127.0.0.1:8084/api/v1/rent' \
--header 'Content-Type: application/json' \
--header 'Authorization: Bearer PNUnJvf3rUda3pFQVRRP5TCgjTOQaW4BL5eFaFulLKCIaxUsS0dzQKqfqn6K' \
--data '{
    "product_id": 8,
    "period_id": 4
}'

RESPONSE:

{
    "data": {
        "id": 3,
        "user": {
            "id": 5,
            "name": "Jaylen Jacobi",
            "email": "uconsidine@example.net"
        },
        "product": {
            "id": 8,
            "title": "Shields-McClure",
            "rental_cost_per_hour": 70,
            "code": "19b55ea1-f75c-4d90-8543-9ebf35be8e8a"
        },
        "rented_start": "2023-11-30 07:08:47",
        "rented_end": "2023-12-01 07:08:47",
        "cosct": 1440
    }
}
...

```