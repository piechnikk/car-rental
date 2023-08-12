SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `cars` (
  `id_cars` int(11) NOT NULL,
  `id_models` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `color` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cars` (`id_cars`, `id_models`, `year`, `color`, `price`, `url`) VALUES
(1, 4, '2020', 'red', 1000, './assets/tesla.jpeg'),
(2, 3, '2006', 'silver', 150, './assets/golf.jpg'),
(3, 2, '2004', 'orange', 100, './assets/micra.jpg'),
(4, 1, '1999', 'black', 80, './assets/astra.png');

CREATE TABLE `models` (
  `id_models` int(11) NOT NULL,
  `brand` varchar(32) NOT NULL,
  `model` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `models` (`id_models`, `brand`, `model`) VALUES
(1, 'Opel', 'Astra'),
(2, 'Nissan', 'Micra'),
(3, 'Volkswagen', 'Golf'),
(4, 'Tesla', 'Model 3');

CREATE TABLE `reservations` (
  `id_reservations` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_cars` int(11) NOT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'waiting',
  `start_time` date NOT NULL,
  `end_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `reservations` (`id_reservations`, `id_users`, `id_cars`, `status`, `start_time`, `end_time`) VALUES
(7, 1, 3, 'accepted', '2023-08-12', '2023-08-26'),
(8, 2, 4, 'waiting', '2023-08-12', '2023-08-24');

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `login` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `account_type` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id_users`, `login`, `password`, `account_type`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
(2, 'janusz', '5b21d20cd679bc06aa4682fa642c076510ec0ded', 'activateUser'),
(3, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'activateUser'),
(4, 'testt', '453cf2486f88c411f9ad608b563aef965cedb15d', 'activateUser'),
(5, 'qwer', '1161e6ffd3637b302a5cd74076283a7bd1fc20d3', 'user'),
(6, 'asdf', '95c0282573633eb230f5064039e6b359e05e8752', 'user');


ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_cars`),
  ADD KEY `id_models` (`id_models`) USING BTREE;

ALTER TABLE `models`
  ADD PRIMARY KEY (`id_models`);

ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservations`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_cars` (`id_cars`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);


ALTER TABLE `cars`
  MODIFY `id_cars` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `models`
  MODIFY `id_models` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `reservations`
  MODIFY `id_reservations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`id_models`) REFERENCES `models` (`id_models`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id_cars`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
