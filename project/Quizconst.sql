DROP DATABASE IF EXISTS `quizconst`;
CREATE DATABASE `quizconst`;
USE `quizconst`;

CREATE TABLE `category` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);


CREATE TABLE `quiz` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255),
  `user_id` integer,
  `category_id` integer,
  `description` varchar(255),
  `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
);


CREATE TABLE `flashcard` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `quiz_id` integer,
  `front_id` integer,
  `reverse_id` integer
);

CREATE TABLE `side` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `content` varchar(255),
  `img_path` varchar(255)
);

CREATE TABLE `attempt` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `quiz_id` integer,
  `user_id` integer,
  `mode` varchar(64),
  `started_at` TIMESTAMP NOT NULL DEFAULT NOW(),
  `finished_at` timestamp
);

CREATE TABLE `attempt_flashcards_answer` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `attempt_id` integer,
  `flashcard_id` integer,
  `is_known` boolean
);

CREATE TABLE `attempt_test_answer` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `attempt_id` integer,
  `question_side_id` integer
);

CREATE TABLE `attempt_test_option` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `test_answer_id` integer,
  `side_id` integer,
  `is_correct` boolean,
  `is_selected` boolean
);

CREATE TABLE `permission` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `permission` varchar(255),
  `role_id` integer
);

CREATE TABLE `role` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `user` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_name` varchar(255),
  `email` varchar(255),
  `password_hash` varchar(255),
  `created_at` TIMESTAMP NOT NULL DEFAULT NOW(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
);


CREATE TABLE `log` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `action` varchar(255),
  `user_id` integer,
  `created_at` TIMESTAMP NOT NULL DEFAULT NOW()
);

ALTER TABLE `quiz` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

ALTER TABLE `quiz` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `attempt` ADD FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

ALTER TABLE `attempt` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `attempt_flashcards_answer` ADD FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`id`);

ALTER TABLE `attempt_test_answer` ADD FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`id`);

ALTER TABLE `attempt_test_answer` ADD FOREIGN KEY (`question_side_id`) REFERENCES `side` (`id`);

ALTER TABLE `attempt_test_option` ADD FOREIGN KEY (`test_answer_id`) REFERENCES `attempt_test_answer` (`id`);

ALTER TABLE `attempt_test_option` ADD FOREIGN KEY (`side_id`) REFERENCES `side` (`id`);

ALTER TABLE `flashcard` ADD FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

ALTER TABLE `flashcard` ADD FOREIGN KEY (`front_id`) REFERENCES `side` (`id`);

ALTER TABLE `flashcard` ADD FOREIGN KEY (`reverse_id`) REFERENCES `side` (`id`);

ALTER TABLE `permission` ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

CREATE TABLE `user_role` (
  `user_id` integer,
  `role_id` integer,
  PRIMARY KEY (`user_id`, `role_id`)
);

ALTER TABLE `user_role` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user_role` ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

ALTER TABLE `log` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);


-- Fill the database with startup data

INSERT INTO `category` (`name`) VALUES ('Mathematics'), ('Physics'), ('Chemistry'), ('Biology'), ('History'), ('Geography'), ('English'), ('Computer Science'), ('Car Mechanic'), ('Cooking');

INSERT INTO `role` (`name`) VALUES ('user'), ('admin');

INSERT INTO `permission` (`permission`, `role_id`) VALUES ('create_quiz', 1), ('edit_own_quiz', 1), ('delete_own_quiz', 1), ('edit_quiz', 2), ('delete_quiz', 2), ('create_user', 2), ('edit_user', 2), ('delete_user', 2), ('create_category', 2), ('edit_category', 2), ('delete_category', 2), ('create_type', 2), ('edit_type', 2), ('delete_type', 2), ('create_role', 2), ('edit_role', 2), ('delete_role', 2), ('create_permission', 2), ('edit_permission', 2), ('delete_permission', 2);


