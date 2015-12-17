-- --------------------------------------------------------
SET foreign_key_checks = 0;
-- --------------------------------------------------------

--  -----------------------------------------------------
-- Удаление всех таблиц из БД
-- -----------------------------------------------------

DROP TABLE IF EXISTS `address`;
DROP TABLE IF EXISTS `city`;
DROP TABLE IF EXISTS `doc`;
DROP TABLE IF EXISTS `experience`;
DROP TABLE IF EXISTS `file`;

DROP TABLE IF EXISTS `firm`;
DROP TABLE IF EXISTS `person`;
DROP TABLE IF EXISTS `profession`;
DROP TABLE IF EXISTS `rec_status`;
DROP TABLE IF EXISTS `rec_state`;
DROP TABLE IF EXISTS `region`;

DROP TABLE IF EXISTS `resume`;
DROP TABLE IF EXISTS `resume_profession`;
DROP TABLE IF EXISTS `resume_status`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `workplace`;

DROP TABLE IF EXISTS `vacancy`;
DROP TABLE IF EXISTS `doc_inn`;
DROP TABLE IF EXISTS `doc_passport`;
DROP TABLE IF EXISTS `doc_medical`;
DROP TABLE IF EXISTS `doc_patent`;

DROP TABLE IF EXISTS `doc_exam`;
DROP TABLE IF EXISTS `doc_migration`;
DROP TABLE IF EXISTS `doc_registration`;









-- --------------------------------------------------------
SET foreign_key_checks = 1;
-- --------------------------------------------------------


-- -----------------------------------------------------
-- Создание таблиц
-- -----------------------------------------------------


--  -----------------------------------------------------
-- Справочник "Пользователи"
-- -----------------------------------------------------
CREATE TABLE `user` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `login`         VARCHAR(50)  NOT NULL UNIQUE COMMENT 'Логин',
  `password`      VARCHAR(50)  NOT NULL COMMENT 'Пароль',
  `access_token`  VARCHAR(128) NULL COMMENT 'Токен',
  `auth_key`      VARCHAR(128) NULL COMMENT 'Ключ',
  `name`          VARCHAR(128) NULL COMMENT 'Ф.И.О.',
  `email`         VARCHAR(128) NULL COMMENT 'Электронная почта',
  `phone`         VARCHAR(128) NULL COMMENT 'Телефон',
  `firm_id`       INT          NULL COMMENT 'Фирма-работодатель',
  `workplace_id`  INT          NULL COMMENT 'Рабочее место',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
-- ДОБАВЛЯЕТСЯ НИЖЕ FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`),
-- ДОБАВЛЯЕТСЯ НИЖЕ FOREIGN KEY (`workplace_id`) REFERENCES `workplace` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Пользователи"';
-- Данные
INSERT INTO `user` (`id`, `login`, `password`, `name`, `rec_status_id`, `user_id`) VALUES
  (1, 'admin', md5('admin'), 'Ф.И.О. admin', 1, 1),
  (2, 'user', md5('user'), 'Ф.И.О. user', 1, 1);


-- -----------------------------------------------------
-- Справочник "Состояние записей"
-- -----------------------------------------------------
CREATE TABLE `rec_status` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Состояние записи',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Состояние записей"';
-- Данные
INSERT INTO `rec_status` (`id`, `name`, `rec_status_id`, `user_id`) VALUES
  (1, 'Активна', 1, 1),
  (2, 'Не активна', 1, 1);


-- -----------------------------------------------------
-- Таблица данных "Рабочие места"
-- -----------------------------------------------------
CREATE TABLE `workplace` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Рабочее место',
  `address_id`    INT          NULL COMMENT 'Адрес',
  `email`         VARCHAR(128) NULL COMMENT 'Электронная почта',
  `phone`         VARCHAR(128) NULL COMMENT 'Телефон',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
#   FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Рабочие места"';


-- -----------------------------------------------------
-- Справочник "Регионы"
-- -----------------------------------------------------
CREATE TABLE `region` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Регион',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Регионы"';


-- -----------------------------------------------------
-- Справочник "Города"
-- -----------------------------------------------------
CREATE TABLE `city` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Населенный пункт',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Города"';


-- -----------------------------------------------------
-- Таблица данных "Адреса"
-- -----------------------------------------------------
CREATE TABLE `address` (
  `id`            INT         NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `region_id`     INT         NULL COMMENT 'Регион',
  `city_id`       INT         NULL COMMENT 'Населенный пункт',
  `street`        VARCHAR(50) NULL COMMENT 'Улица',
  `house`         VARCHAR(20) NULL COMMENT 'Дом',
  `room`          VARCHAR(20) NULL COMMENT 'Квартира',
  `note`          TEXT        NULL COMMENT 'Примечание',
  `rec_status_id` INT         NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT         NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP   NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`street`),
  FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Адреса"';


-- -----------------------------------------------------
-- Справочник "Предприятия"
-- -----------------------------------------------------
CREATE TABLE `firm` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Наименование предприятия',
  `full_name`     VARCHAR(128) NULL COMMENT 'Полное наименование предприятия',
  `okpo`          VARCHAR(20)  NULL COMMENT 'Код предприятия',
  `address_id`    INT          NULL COMMENT 'Адрес',
  `director`      VARCHAR(128) NULL COMMENT 'Директор',
  `email`         VARCHAR(128) NULL COMMENT 'Электронная почта',
  `phone`         VARCHAR(128) NULL COMMENT 'Телефон',
  `bank_name`     VARCHAR(128) NULL COMMENT 'Наименование банка',
  `bank_mfo`      VARCHAR(10)  NULL COMMENT 'МФО банка',
  `bank_rs`       VARCHAR(20)  NULL COMMENT 'Р/с',
  `svid_num`      VARCHAR(20)  NULL COMMENT 'Номер свидетельства налогоплательщика',
  `svid_date`     DATE         NULL COMMENT 'Дата выдачи свидетельства',
  `svid_who_give` VARCHAR(128) NULL COMMENT 'Орган, выдавший свидетельство',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`okpo`),
  FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Предприятия"';


-- -----------------------------------------------------
-- Справочник "Наименования профессий"
-- -----------------------------------------------------
CREATE TABLE `profession` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Наименование профессии',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Наименования профессий"';


-- -----------------------------------------------------
-- Таблица данных "Вакансии"
-- -----------------------------------------------------
CREATE TABLE `vacancy` (
  `id`            INT            NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `date`          DATE           NULL COMMENT 'Дата',
  `firm_id`       INT            NOT NULL COMMENT 'Фирма-работодатель',
  `profession_id` INT            NOT NULL COMMENT 'Должность',
  `salary`        DECIMAL(10, 2) NULL COMMENT 'Зарплата',
  `note`          TEXT           NULL COMMENT 'Описание',
  `workplace_id`  INT            NOT NULL COMMENT 'Рабочее место',
  `rec_status_id` INT            NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT            NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP      NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`profession_id`) REFERENCES `profession` (`id`),
  FOREIGN KEY (`firm_id`) REFERENCES `firm` (`id`),
  FOREIGN KEY (`workplace_id`) REFERENCES `workplace` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Вакансии"';


-- -----------------------------------------------------
-- Таблица данных "Соискатели"
-- -----------------------------------------------------
CREATE TABLE `person` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `lname`         VARCHAR(128) NULL COMMENT 'Фамилия',
  `fname`         VARCHAR(128) NULL COMMENT 'Имя',
  `mname`         VARCHAR(128) NULL COMMENT 'Отчество',
  `birthday`      DATE         NULL COMMENT 'Дата рождения',
  `sex`           TINYINT      NULL COMMENT 'Пол',
  `address_id`    INT          NULL COMMENT 'Адрес',
  `email`         VARCHAR(128) NULL COMMENT 'Электронная почта',
  `phone`         VARCHAR(128) NULL COMMENT 'Телефон',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`lname`),
  INDEX (`fname`),
  INDEX (`mname`),
  FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Соискатели"';


-- -----------------------------------------------------
-- Таблица данных "Опыт работы, обучение"
-- -----------------------------------------------------
CREATE TABLE `experience` (
  `id`                INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `type_id`           INT          NULL COMMENT 'Тип опыта', -- Список (обучение/работа)
  `person_id`         INT          NULL COMMENT 'Человек',
  `education_type_id` INT          NULL COMMENT 'Уровень образования', -- Список (высшее/среднее/среднеспециальное)
  `firm`              VARCHAR(128) NULL COMMENT 'Компания/Учебное заведение',
  `profession_id`     INT          NULL COMMENT 'Профессия',
  `city_id`           INT          NULL COMMENT 'Населенный пункт',
  `date_start`        DATE         NULL COMMENT 'Дата с',
  `date_end`          DATE         NULL COMMENT 'Дата по',
  `duration`          INT          NULL COMMENT 'Продолжительность, дней',
  `note`              TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`     INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`           INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`                TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`type_id`),
  INDEX (`education_type_id`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  FOREIGN KEY (`profession_id`) REFERENCES `profession` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Опыт работы, обучение"';


-- -----------------------------------------------------
-- Таблица данных "Файлы"
-- -----------------------------------------------------
CREATE TABLE `file` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `table_name`    VARCHAR(50)  NULL COMMENT 'Имя таблицы',
  `class_name`    VARCHAR(50)  NULL COMMENT 'Имя модели',
  `rec_id`        INT          NULL COMMENT 'ID записи',
  `type_id`       INT          NULL COMMENT 'Тип файла', -- Список (паспорт, инн и т.д.)
  `file_name`     VARCHAR(50)  NULL COMMENT 'Название файла',
  `file_path`     VARCHAR(128) NULL COMMENT 'Местоположение файла',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`table_name`),
  INDEX (`class_name`),
  INDEX (`rec_id`),
  INDEX (`type_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Файлы"';

/*
-- -----------------------------------------------------
-- Таблица данных "Документы"
-- -----------------------------------------------------
CREATE TABLE `doc` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `type_id`         INT          NULL COMMENT 'Тип документа', -- Список (паспорт, инн и т.д.)
  `name`            VARCHAR(50)  NULL COMMENT 'Наименование документа',
  `series`          VARCHAR(50)  NULL COMMENT 'Серия',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `date_end`        DATE         NULL COMMENT 'Дата окончания',
  `date_renewal`    DATE         NULL COMMENT 'Дата продления',
  `duration_months` INT          NULL COMMENT 'Срок действия, мес.',
  `duration_days`   INT          NULL COMMENT 'Срок действия, дн.',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `address_id`      INT          NULL COMMENT 'Адрес',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`type_id`),
  INDEX (`name`),
  INDEX (`series`),
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы"';
*/

-- -----------------------------------------------------
-- Таблица данных "Документы: Регистрация"
-- -----------------------------------------------------
CREATE TABLE `doc_registration` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `series`          VARCHAR(50)  NULL COMMENT 'Серия',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `date_end`        DATE         NULL COMMENT 'Дата окончания',
  `date_renewal`    DATE         NULL COMMENT 'Дата продления',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `address_id`      INT          NULL COMMENT 'Адрес',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`series`),
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`address_id`) REFERENCES `address` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: Регистрация"';


-- -----------------------------------------------------
-- Таблица данных "Документы: Миграционные карты"
-- -----------------------------------------------------
CREATE TABLE `doc_migration` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `series`          VARCHAR(50)  NULL COMMENT 'Серия',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `duration_months` INT          NULL COMMENT 'Срок действия, мес.',
  `duration_days`   INT          NULL COMMENT 'Срок действия, дн.',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`series`),
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: Миграционные карты"';


-- -----------------------------------------------------
-- Таблица данных "Документы: Экзамены"
-- -----------------------------------------------------
CREATE TABLE `doc_exam` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `series`          VARCHAR(50)  NULL COMMENT 'Серия',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`series`),
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: Экзамены"';


-- -----------------------------------------------------
-- Таблица данных "Документы: Патент"
-- -----------------------------------------------------
CREATE TABLE `doc_patent` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `duration_months` INT          NULL COMMENT 'Срок действия, мес.',
  `duration_days`   INT          NULL COMMENT 'Срок действия, дн.',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: Патент"';


-- -----------------------------------------------------
-- Таблица данных "Документы: Медосмотр"
-- -----------------------------------------------------
CREATE TABLE `doc_medical` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `duration_months` INT          NULL COMMENT 'Срок действия, мес.',
  `duration_days`   INT          NULL COMMENT 'Срок действия, дн.',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: Медосмотр"';

-- -----------------------------------------------------
-- Таблица данных "Документы: ИНН"
-- -----------------------------------------------------
CREATE TABLE `doc_inn` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: ИНН"';


-- -----------------------------------------------------
-- Таблица данных "Документы: Паспорт"
-- -----------------------------------------------------
CREATE TABLE `doc_passport` (
  `id`              INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`       INT          NULL COMMENT 'Владелец',
  `series`          VARCHAR(50)  NULL COMMENT 'Серия',
  `num`             VARCHAR(50)  NULL COMMENT 'Номер',
  `date`            DATE         NULL COMMENT 'Дата выдачи',
  `who_give`        VARCHAR(128) NULL COMMENT 'Орган, выдавший документ',
  `note`            TEXT         NULL COMMENT 'Примечание',
  `rec_status_id`   INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`         INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`              TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  INDEX (`series`),
  INDEX (`num`),
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Документы: Паспорт"';


-- -----------------------------------------------------
-- Справочник "Статус резюме"
-- -----------------------------------------------------
CREATE TABLE `resume_status` (
  `id`            INT          NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `name`          VARCHAR(128) NOT NULL UNIQUE COMMENT 'Статус резюме',
  `note`          TEXT         NULL COMMENT 'Примечание',
  `rec_status_id` INT          NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT          NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP    NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Справочник "Статус резюме"';
-- Данные
INSERT INTO `resume_status` (`id`, `name`, `rec_status_id`, `user_id`) VALUES
  (1, 'Черновик', 1, 1),
  (10, 'Заполнено', 1, 1),
  (20, 'В поиске', 1, 1),
  (30, 'Трудоустроен', 1, 1);


-- -----------------------------------------------------
-- Таблица данных "Резюме"
-- -----------------------------------------------------
CREATE TABLE `resume` (
  `id`               INT            NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `person_id`        INT            NOT NULL COMMENT 'Соискатель',
  `salary`           DECIMAL(10, 2) NULL COMMENT 'Зарплата',
  `vacancy_id`       INT            NULL COMMENT 'Вакансия',
  `date_start`       DATE           NULL COMMENT 'Дата трудоустройства',
  `date_end`         DATE           NULL COMMENT 'Трудоустроен до',
  `note`             TEXT           NULL COMMENT 'Описание',
  `resume_status_id` INT            NOT NULL COMMENT 'Статус резюме',
  `workplace_id`     INT            NOT NULL COMMENT 'Рабочее место',
  `rec_status_id`    INT            NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`          INT            NOT NULL COMMENT 'Кем добавлена запись',
  `dc`               TIMESTAMP      NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  FOREIGN KEY (`vacancy_id`) REFERENCES `vacancy` (`id`),
  FOREIGN KEY (`resume_status_id`) REFERENCES `resume_status` (`id`),
  FOREIGN KEY (`workplace_id`) REFERENCES `workplace` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Резюме"';


-- -----------------------------------------------------
-- Таблица данных "Желаемые должности"
-- -----------------------------------------------------
CREATE TABLE `resume_profession` (
  `id`            INT       NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
  `resume_id`     INT       NOT NULL COMMENT 'Резюме',
  `profession_id` INT       NOT NULL COMMENT 'Профессия',
  `note`          TEXT      NULL COMMENT 'Описание',
  `rec_status_id` INT       NOT NULL DEFAULT 1 COMMENT 'Состояние записи',
  `user_id`       INT       NOT NULL COMMENT 'Кем добавлена запись',
  `dc`            TIMESTAMP NOT NULL COMMENT 'Когда добавлена запись',
  FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`profession_id`) REFERENCES `profession` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`)
) ENGINE = InnoDB COMMENT = 'Таблица данных "Желаемые должности"';


-- Добавление внешнего ключа для таблицы "Пользователи"
ALTER TABLE `user`
ADD FOREIGN KEY (`rec_status_id`) REFERENCES `rec_status` (`id`),
ADD FOREIGN KEY (`workplace_id`) REFERENCES `workplace` (`id`);


-- Добавление внешнего ключа для таблицы "Пользователи"
ALTER TABLE `workplace`
ADD FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);
