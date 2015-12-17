drop table if exists `auth_assignment`;
drop table if exists `auth_item_child`;
drop table if exists `auth_item`;
drop table if exists `auth_rule`;

create table `auth_rule`
(
    `name`  varchar(64) not null,
    `data`  text,
    `created_at`           integer,
    `updated_at`           integer,
    primary key (`name`)
);

create table `auth_item`
(
   `name`                 varchar(64) not null,
   `type`                 integer not null,
   `description`          text,
   `rule_name`            varchar(64),
   `data`                 text,
   `created_at`           integer,
   `updated_at`           integer,
   primary key (`name`),
   foreign key (`rule_name`) references `auth_rule` (`name`) on delete set null on update cascade
);

create index `idx-auth_item-type` on `auth_item` (`type`);

create table `auth_item_child`
(
   `parent`               varchar(64) not null,
   `child`                varchar(64) not null,
   primary key (`parent`,`child`),
   foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
   foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade
);

create table `auth_assignment`
(
   `item_name`            varchar(64) not null,
   `user_id`              varchar(64) not null,
   `created_at`           integer,
   primary key (`item_name`, `user_id`),
   foreign key (`item_name`) references `auth_item` (`name`) on delete cascade on update cascade
);

INSERT INTO `auth_item` (`name`, `type`) VALUES
  ('/*', 2);

INSERT INTO `auth_item` (`name`, `type`, `description`) VALUES
  ('admin', 1, 'Полный доступ'),
  ('user', 1, 'Ограниченный доступ');

INSERT INTO `auth_assignment` (`item_name`, `user_id`) VALUES
  ('admin', 1);

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
  ('admin', '/*');
