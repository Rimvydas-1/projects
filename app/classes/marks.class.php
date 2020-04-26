<?php

/**
 * Class Marks
 * extends Dbh
 *
 */
class Marks extends Dbh{

    /**
     * @return array
     * calls `student_averages` procedure
     * and puts it into json ready assoc array
     */
    public function AvgMarksTable()
    {
        $sql = "CALL `student_averages()`";
        $result = $this->query($sql); //užklausos įvykdymas - kviečiam sukurtą procedūrą
        $this->closeConn(); //rezulata gavom - galim uzdaryti connection
        if(isset($result)) {
            while ($row = $result->fetch_assoc()) {
                $data['headers'][$row['subject_id']] = $row['subject_name'];
                $data['student'][$row['id']]['id'] = $row['id'];
                $data['student'][$row['id']]['full_name'] = trim($row['first_name'] . " " . $row['last_name']);
                $data['student'][$row['id']]['univ_name'] = $row['univ_name'];
                $data['student'][$row['id']]['subjects'][$row['subject_id']]['average'] = $row['average'];
            }
            if(is_array($data)) {
                $tableInfo['headers']['univ_name'] = "Universiteto pavadinimas";
                $tableInfo['headers']['full_name'] = "Vardas Pavardė";
                foreach ($data['student'] AS $key => $studentData) {
                    $tableInfo['data'][$key]['univ_name'] = $studentData['univ_name'];
                    $tableInfo['data'][$key]['full_name'] = $studentData['full_name'];
                    // vidurkius i masyva sudeliojam pagal `headers` eiliskuma
                    foreach ($data['headers'] AS $subject_id => $subject) {
                        $tableInfo['headers']['average_' . $subject_id] = $subject;
                        $tableInfo['data'][$key]['average_' . $subject_id] = $studentData['subjects'][$subject_id]['average'];
                    }
                }
                return $tableInfo; // gražinam masyvą
            }
        }

    }

}
