# API Endpoints

All endpoints require an `Authorization: Bearer <token>` header containing a valid Laravel Sanctum token.

## Clients
- `GET /api/clients` – List clients
- `GET /api/clients/{id}` – Retrieve a client
- `POST /api/clients` – Create a client
- `PUT /api/clients/{id}` – Update a client
- `DELETE /api/clients/{id}` – Delete a client

## Locations
- `GET /api/locations` – List locations
- `GET /api/locations/{id}` – Retrieve a location
- `POST /api/locations` – Create a location
- `PUT /api/locations/{id}` – Update a location
- `DELETE /api/locations/{id}` – Delete a location

## Orders
- `GET /api/orders` – List orders
- `GET /api/orders/{id}` – Retrieve an order
- `POST /api/orders` – Create an order
- `PUT /api/orders/{id}` – Update an order
- `DELETE /api/orders/{id}` – Delete an order

## Schedules
- `GET /api/schedules` – List schedules
- `GET /api/schedules/{id}` – Retrieve a schedule
- `POST /api/schedules` – Create a schedule
- `PUT /api/schedules/{id}` – Update a schedule
- `DELETE /api/schedules/{id}` – Delete a schedule

