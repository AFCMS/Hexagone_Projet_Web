CREATE TABLE `projects_reviews`
(
    `id`         int           NOT NULL AUTO_INCREMENT,
    `project_id` int           NOT NULL,
    `user_name`  varchar(10)   NOT NULL,
    `note`       int           NOT NULL,
    `text`       varchar(2048) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `project_id` (`project_id`, `user_name`),
    KEY `user_name` (`user_name`),
    CONSTRAINT `projects_reviews_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `projects_reviews_ibfk_2` FOREIGN KEY (`user_name`) REFERENCES `users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `projects_reviews_chk_1` CHECK (((`note` <= 5) and (`note` >= 0)))
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci