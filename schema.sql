CREATE DATABASE doingsdone
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

create table Project (
	id INT AUTO_INCREMENT PRIMARY KEY,
	project_name VARCHAR(128),
	user_id INT NOT NULL
);

create table Task (
	id INT AUTO_INCREMENT PRIMARY KEY,
	task_name CHAR(128) NOT NULL,
	create_at DATETIME DEFAULT NOW(),
	deadline DATETIME,
	done_at DATETIME,
	file_task VARCHAR(128),
	project_id INT,
	user_id INT NOT NULL,
	status BOOLEAN DEFAULT FALSE
);

create table User (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name_user VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL ,
	password CHAR(64) NOT NULL,
	reg_date DATETIME NOT NULL DEFAULT NOW()
);

CREATE UNIQUE INDEX email ON User(email);
CREATE UNIQUE INDEX getProject ON Project(project_name,user_id);
CREATE INDEX doneTask ON Task(user_id,project_id);