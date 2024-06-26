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

CREATE TABLE `permission` ( `name` varchar(255) PRIMARY KEY );

CREATE TABLE `role` (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255)
);

CREATE TABLE `user` (
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    `user_name` varchar(255),
    `email` varchar(255),
    `role_id` integer,
    `avatar_url` varchar(255),
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

ALTER TABLE `quiz`
ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

ALTER TABLE `quiz`
ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `attempt`
ADD FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

ALTER TABLE `attempt`
ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `attempt_flashcards_answer`
ADD FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`id`);

ALTER TABLE `attempt_test_answer`
ADD FOREIGN KEY (`attempt_id`) REFERENCES `attempt` (`id`);

ALTER TABLE `attempt_test_answer`
ADD FOREIGN KEY (`question_side_id`) REFERENCES `side` (`id`);

ALTER TABLE `attempt_test_option`
ADD FOREIGN KEY (`test_answer_id`) REFERENCES `attempt_test_answer` (`id`);

ALTER TABLE `attempt_test_option`
ADD FOREIGN KEY (`side_id`) REFERENCES `side` (`id`);

ALTER TABLE `flashcard`
ADD FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

ALTER TABLE `flashcard`
ADD FOREIGN KEY (`front_id`) REFERENCES `side` (`id`);

ALTER TABLE `flashcard`
ADD FOREIGN KEY (`reverse_id`) REFERENCES `side` (`id`);

ALTER TABLE `user`
ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

CREATE TABLE `role_permission` (
    `role_id` integer,
    `permission_name` varchar(255),
    PRIMARY KEY (`role_id`, `permission_name`)
);

ALTER TABLE `role_permission`
ADD FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

ALTER TABLE `role_permission`
ADD FOREIGN KEY (`permission_name`) REFERENCES `permission` (`name`);

ALTER TABLE `log`
ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

-- Fill the database with startup data

INSERT INTO
    `category` (`name`)
VALUES ('Mathematics'),
    ('Physics'),
    ('Chemistry'),
    ('Biology'),
    ('History'),
    ('Geography'),
    ('English'),
    ('Computer Science'),
    ('Car Mechanic'),
    ('Cooking');

INSERT INTO `role` (`name`) VALUES ('user'), ('admin');

INSERT INTO
    `permission` (`name`)
VALUES ('create_quiz'),
    ('edit_own_quiz'),
    ('delete_own_quiz'),
    ('edit_quiz'),
    ('delete_quiz'),
    ('create_user'),
    ('edit_user'),
    ('delete_user'),
    ('create_category'),
    ('edit_category'),
    ('delete_category'),
    ('create_type'),
    ('edit_type'),
    ('delete_type'),
    ('create_role'),
    ('edit_role'),
    ('delete_role'),
    ('edit_profile'),
    ('edit_own_profile'),
    ('is_admin'),
    ('export_score'),
    ('view_logs');

INSERT INTO
    `role_permission` (`permission_name`, `role_id`)
VALUES ('create_quiz', 2),
    ('edit_own_quiz', 2),
    ('delete_own_quiz', 2),
    ('edit_quiz', 2),
    ('delete_quiz', 2),
    ('create_user', 2),
    ('edit_user', 2),
    ('delete_user', 2),
    ('create_category', 2),
    ('edit_category', 2),
    ('delete_category', 2),
    ('create_type', 2),
    ('edit_type', 2),
    ('delete_type', 2),
    ('create_role', 2),
    ('edit_role', 2),
    ('delete_role', 2),
    ('edit_profile', 2),
    ('is_admin', 2),
    ('export_score', 2),
    ('view_logs', 2),
    ('edit_own_profile', 1),
    ('create_quiz', 1),
    ('edit_own_quiz', 1),
    ('delete_own_quiz', 1);

INSERT INTO
    `user` (
        `user_name`,
        `password_hash`,
        `role_id`
    )
VALUES (
        'admin',
        '$2y$10$JnAce229Im5vLyMkNcqgauu4BFmAZA2.aNBwt/r4SKdsfO678Lzta',
        2
    );