# car-rental
This is a responsive car rental website built using JavaScript, Svelte, TailwindCSS, PHP and MySQL. The project was created in secondary school.

<details>
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#live-demo">Live Demo</a></li>
    <li><a href="#setup">Setup</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#technologies">Technologies</a></li>
  </ul>
</details>

## Live Demo

Explore the [live demo](https://piechnik.ct8.pl/car-rental/) of the car-rental website.

#### ACCOUNTS
 - admin - username: admin, password: admin
 - mod - username: mod, password: mod

## Setup

To get a copy of this project up and running on your local machine, follow these steps:

1. Clone the repository to the place where the php interpreter is running (e.g. xampp - htdocs) : 
```
git clone https://github.com/piechnikk/car-rental.git
```
2. Create a MySQL database named `cars` and import `src/database/cars.sql`

## Usage

Open your preferred web browser and navigate to `http://localhost/car-rental` (address can be different depending on the php interpreter used) to access the running application.

#### FEATURES
 - Login/Registration
 - Car Reservation
 - Admin can change user type and activate user account
 - Mod can accept and reject reservations requests
 - QR code when reservation is accepted

#### INTERFACE
![cars list](https://github.com/piechnikk/car-rental/assets/51060535/d72f6c8d-cfc6-4011-b031-cfb0abecb46a)
![car details](https://github.com/piechnikk/car-rental/assets/51060535/6560203c-5eed-4ea6-bb4c-c0d0194d0147)
![sign in](https://github.com/piechnikk/car-rental/assets/51060535/ce77c102-4f34-4fb4-b2ca-40a0f3a75c2a)
![sign up](https://github.com/piechnikk/car-rental/assets/51060535/95e7a45f-948b-4266-a70f-0408ce35ee49)
![my reservations](https://github.com/piechnikk/car-rental/assets/51060535/9407adec-73c5-4799-a0b4-8c8cc03f77a2)
![mod](https://github.com/piechnikk/car-rental/assets/51060535/80ee0914-83b7-4533-935d-7bdcaddadf71)
![admin](https://github.com/piechnikk/car-rental/assets/51060535/f567194c-193f-4d2c-b80f-3a1fb640a768)

## Technologies

<div>
    <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" alt="JavaScript">
    <img src="https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00" alt="Svelte">
    <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="TailwindCSS">
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</div>

---

**Note**: This project was created in secondary school and serves as an example of a responsive car rental website.
