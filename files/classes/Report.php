<?php
class Report
{
    public function __construct(private Database $db) {}

    public function attendanceSummary(): array
    {
        return $this->db->query(
            'SELECT s.full_name,
                    SUM(a.status = "present") AS present_count,
                    SUM(a.status = "absent") AS absent_count
             FROM students s
             LEFT JOIN attendance a ON a.student_id = s.id
             GROUP BY s.id, s.full_name
             ORDER BY s.full_name'
        )->fetchAll();
    }
}
