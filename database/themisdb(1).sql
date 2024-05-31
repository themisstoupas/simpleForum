-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 28 Ιαν 2024 στις 18:35:08
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `themisdb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_title`, `date_posted`, `content`, `created_at`, `views`) VALUES
(3, 6, 'new php project!', '2024-01-21 18:15:32', 'php project', '2024-01-21 11:50:54', 0),
(4, 9, 'new editing software!', '2024-01-21 18:45:29', 'do you want to learn to edit your videos with davinci editing software?', '2024-01-21 16:45:29', 0),
(31, 6, 'test san user', '2024-01-28 09:30:17', 'test san user', '2024-01-28 08:30:17', 0),
(33, 26, 'test san admin', '2024-01-28 17:52:43', 'admin', '2024-01-28 16:52:43', 0),
(34, 6, 'test san user', '2024-01-28 17:57:09', 'new test user', '2024-01-28 16:57:09', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `post_replies`
--

CREATE TABLE `post_replies` (
  `reply_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reply_content` text DEFAULT NULL,
  `reply_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `post_replies`
--

INSERT INTO `post_replies` (`reply_id`, `post_id`, `user_id`, `reply_content`, `reply_date`) VALUES
(29, 31, 6, '<p>test san user</p>', '2024-01-28 08:30:29'),
(35, 33, 26, '', '2024-01-28 16:52:50'),
(36, 33, 6, '', '2024-01-28 16:56:47'),
(37, 34, 6, '', '2024-01-28 16:57:15'),
(38, 34, 6, '@', '2024-01-28 16:57:20'),
(39, 34, 6, '2', '2024-01-28 17:27:22');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_at`, `registration_date`) VALUES
(6, 'themis', 'themis@themis', '$2y$10$jGAA4h7FcaeRxvYzhhdk4.bmxeF96SXirXuJg7jn/MzGlTuYWd4b.', 'user', '2024-01-20 10:33:07', '2024-01-21 13:03:45'),
(8, 'geia', 'geia@geia.com', '$2y$10$hMyHIZnx4S4xCnbCFQSYn.9wcq7IW.3XMR3Act.RRNhEKOPuYvciS', 'user', '2024-01-20 11:48:55', '2024-01-21 13:03:45'),
(9, 'stella', 'stella@stella.com', '$2y$10$SiTwR5.4kEwUZBY6W666pOyl3eipAPumVi6ojH.zTrDo.eTtVOzYG', 'user', '2024-01-20 16:54:28', '2024-01-21 13:03:45'),
(11, 'nikos', 'nikos@nikos.com', '$2y$10$dbAQRH4wMiRUH./vvYprPOdmkfDNZt.ySjoCrUIP1zpwXn2i.3Xqq', 'user', '2024-01-21 11:23:16', '2024-01-21 13:23:16'),
(12, 'admin', 'admin@admin.com', '1234', 'admin', '2024-01-21 16:27:50', '2024-01-21 18:27:50'),
(13, 'test', 'test@test.com', '$2y$10$x9c34DLI3N/A/.Wdrn8bJOkdkI/9/QPhfrhA.xiMhvEhkPhsZKIRO', 'user', '2024-01-27 10:36:09', '2024-01-27 12:36:09'),
(14, 'admin', '', '$2y$10$ViBud59C53jcJyACmDF.wei8LcEj4uUEZ/6pYhdFARrfMiTEYo6De', 'admin', '2024-01-27 10:45:10', '2024-01-27 12:45:10'),
(25, 'admin2', 'admin2@admin2.com', '$2y$10$cgoQBuhDIP7lXqnofH5F1eUublZvV/eOGvIhgNmmrmv.Z9.0uKwb.', 'admin', '2024-01-27 11:08:46', '2024-01-27 13:08:46'),
(26, 'themis2', 'themis2@themis2.com', '$2y$10$wJM85BgIE8liZT9zpaKXt.EQYprR.yn72sGo/gQy4HJrn7sgFCVuO', 'admin', '2024-01-27 11:10:07', '2024-01-27 13:10:07'),
(27, 'administator', 'administrator@admin.com', '$2y$10$HSf5wvunOSP4L/qDlqfxnO245TfSk.kkQkjhI/23tqvDrfSK.EDHy', 'admin', '2024-01-28 08:37:35', '2024-01-28 10:37:35'),
(28, 'testuser', 'testuser@test.com', '$2y$10$Nj/JhFz/0OOAR5n1nlDASOKejTmK8HPL8DVH38EC1YEh9T/4HbQz.', 'user', '2024-01-28 08:38:08', '2024-01-28 10:38:08'),
(29, 'stella_admin', 'stella@admin.com', '$2y$10$9NV6Ryn6WQ4x4B2mLpARgug91rTmQJgI3ECOwpkEqm/KGf.CHMRpO', 'admin', '2024-01-28 16:53:22', '2024-01-28 18:53:22');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `post_replies`
--
ALTER TABLE `post_replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT για πίνακα `post_replies`
--
ALTER TABLE `post_replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT για πίνακα `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `post_replies`
--
ALTER TABLE `post_replies`
  ADD CONSTRAINT `post_replies_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_replies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Περιορισμοί για πίνακα `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
