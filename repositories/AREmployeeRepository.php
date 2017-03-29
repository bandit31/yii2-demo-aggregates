<?php

namespace app\repositories;

use app\entities\Employee\Employee;
use app\entities\Employee\EmployeeId;
use Ramsey\Uuid\Uuid;

class AREmployeeRepository implements EmployeeRepository
{
    /**
     * @param EmployeeId $id
     * @return Employee
     */
    public function get(EmployeeId $id)
    {
        if (!$employee = Employee::findOne($id->getId())) {
            throw new NotFoundException('Employee not found.');
        }
        return $employee;
    }

    public function add(Employee $employee)
    {
        if (!$employee->insert()) {
            throw new \RuntimeException('Adding error.');
        }
    }

    public function save(Employee $employee)
    {
        if (!$employee->update()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Employee $employee)
    {
        if (!$employee->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function nextId()
    {
        return new EmployeeId(Uuid::uuid4()->toString());
    }
}