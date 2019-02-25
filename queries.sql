use doingsdone;
INSERT INTO User (name_user, email, password, Register_at)
VALUES
('Denis', 'Den777@krsk.com', md5('123456'), NOW()), -- 1
('Alex', 'Alex61@htmlacademy.com', md5('qwerty'), NOW());--2

INSERT INTO Project (project_name, user_id)
VALUES
('Входящие', 1), -- 1
('Учеба',    1), -- 2
('Работа',   2), -- 3
('Домашние дела', 2), -- 4
('Авто', 1); -- 5

INSERT INTO Task (task_name, create_at, deadline_at, done_at, file_task, project_id, user_id, status)
VALUES
('Собеседование в IT компании', NOW(), null, '2019-02-23', 'Home.psd', 3, 1, false), -- 1
('Выполнить тестовое задание', NOW(), null, '2019-02-22', 'Home.psd', 3, 1, false), -- 2
('Сделать задание первого раздела', NOW(), null, '2019-01-21', 'Home.psd', 2, 2, true), -- 3
('Встреча с другом', NOW(), null, '2019-12-19', 'Home.psd', 1, 1, false), -- 4
('Купить корм для кота', NOW(), null, '2019-02-20', 'Home.psd', 4, 2, false), -- 5
('Заказать пиццу', NOW(), null, '1998-01-31', 'Home.psd', 4, 2, false); -- 6

-- получить список из всех проектов для одного пользователя
SELECT id, project_name
  FROM Project
 WHERE user_id = 2;

-- получить список из всех задач для одного проекта
SELECT task_name, file_task, done_at, deadline_at, status, project_id
  FROM Task  where project_id = 1;

-- пометить задачу как выполненную
UPDATE Task SET status = true, done_at = NOW()
WHERE id = 2;

-- обновить название задачи по её идентификатору
UPDATE Task SET task_name = 'Заказать такси'
WHERE id = 6;