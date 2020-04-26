DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `student_averages()`()
    READS SQL DATA
SELECT student.id,student.first_name, student.last_name, ROUND(AVG(mark),1) AS average, subject.name AS subject_name, university.name AS univ_name, subject_id FROM mark INNER JOIN student ON student.id = mark.student_id INNER JOIN subject ON subject.id = mark.subject_id INNER JOIN university ON university.id = student.university_id WHERE 1 GROUP BY student_id, subject_id$$
DELIMITER ;