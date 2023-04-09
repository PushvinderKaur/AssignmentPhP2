

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `students` (
  `id` int(6) UNSIGNED NOT NULL,
  `student_id` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` VARCHAR(40) NOT NULL;
  `gender` varchar(10) NOT NULL,
  `gpa` decimal(3,2) NOT NULL,
  `program` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `students`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

