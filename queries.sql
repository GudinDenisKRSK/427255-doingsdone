use doingsdone;
INSERT INTO User (name_user, email, password, Register_at)
VALUES
('Denis', 'Den777@krsk.com', md5('123456'), NOW()), -- 1
('Alex', 'Alex61@htmlacademy.com', md5('qwerty'), NOW());--2

INSERT INTO Project (project_name, user_id)
VALUES
('��������', 1), -- 1
('�����',    1), -- 2
('������',   2), -- 3
('�������� ����', 2), -- 4
('����', 1); -- 5

INSERT INTO Task (task_name, create_at, deadline_at, done_at, file_task, project_id, user_id, status)
VALUES
('������������� � IT ��������', NOW(), null, '2019-02-23', 'Home.psd', 3, 1, false), -- 1
('��������� �������� �������', NOW(), null, '2019-02-22', 'Home.psd', 3, 1, false), -- 2
('������� ������� ������� �������', NOW(), null, '2019-01-21', 'Home.psd', 2, 2, true), -- 3
('������� � ������', NOW(), null, '2019-12-19', 'Home.psd', 1, 1, false), -- 4
('������ ���� ��� ����', NOW(), null, '2019-02-20', 'Home.psd', 4, 2, false), -- 5
('�������� �����', NOW(), null, '1998-01-31', 'Home.psd', 4, 2, false); -- 6

-- �������� ������ �� ���� �������� ��� ������ ������������
SELECT id, project_name
  FROM Project
 WHERE user_id = 2;

-- �������� ������ �� ���� ����� ��� ������ �������
SELECT task_name, file_task, done_at, deadline_at, status, project_id
  FROM Task  where project_id = 1;

-- �������� ������ ��� �����������
UPDATE Task SET status = true, done_at = NOW()
WHERE id = 2;

-- �������� �������� ������ �� � ��������������
UPDATE Task SET task_name = '�������� �����'
WHERE id = 6;