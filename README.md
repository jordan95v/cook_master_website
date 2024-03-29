# Cook Master Website

## Description

This is a website made for the ESGI's annual project. It's a website where you can find recipes, buy kitchen ustensils and order private lessons.

## Installation

This project use docker and docker-compose to run. You can install them with the following commands:

```bash
sudo apt install docker.io
sudo apt install docker-compose
```

⚠️ Be sure the create a proper .env file in the root of the project. You can use the .env.example file as a template. ⚠️

In order to launch the project, you need to run the following command:

```bash
docker-compose up -d --build
```

Then you go to your browser and type the following url: `aterlierdesgourmets.localhost`

And there you go, the website is live and running.

### Database

If you want to have a fresh database without any data, you can replace the line 14 in the `entrypoint.sh` file:

```bash
# Remove this line
php /app/artisan migrate --force --seed

# By this line
php /app/artisan migrate --force
```

## Stack

This project use the following stack:

- PHP 8.2s
- MySQL (database)
- Caddy (webserver)

## Functionnality

List of all websites functionnalities:

- User can register and login, modify their profile,
- Admin can add, edit and delete events, rooms, product, courses and equipments,
- Admin can also manage users, banning them, promoting them to admin, prestation or deleting them,
- Users can subscribe to differents plans,
- Users can purchase some items from the store, and an invoice will be generated,
- Users can register to an event, and have information on the location, ...