
# Event Manager

A simple laravel project for managing events/courses.

## Installation

- Clone the project

```bash
  git clone https://github.com/elton-tanaka/event-manager.git
```

- Go to the project directory

```bash
  cd event-manager
```

- Run composer

```bash
  composer install
```
- Update .env file

- Build docker container

```bash
  ./vendor/bin/sail build
  ./vendor/bin/sail up -d
```
- Run migration (Optional: with seeder):

```bash
  ./vendor/bin/sail php artisan migrate:fresh --seed
```
## Features

- Login and Register .features using livewire
- Create/View/Edit/Delete Events.
- List of all Events.
- User Dashboard.
- Participants counter.
- Promoted Events always shows on top.
- Api for retrieving Events info.
- pt-br localization
- Sick theme

## Screenshots

![App Screenshot 1](/public/img/screenshots/localhost_.png)

![App Screenshot 2](/public/img/screenshots/localhost_dashboard.png)

![App Screenshot 3](/public/img/screenshots/localhost_events_1.png)

