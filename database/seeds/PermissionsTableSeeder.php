<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'student_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'student_create',
            ],
            [
                'id'    => '19',
                'title' => 'student_edit',
            ],
            [
                'id'    => '20',
                'title' => 'student_show',
            ],
            [
                'id'    => '21',
                'title' => 'student_delete',
            ],
            [
                'id'    => '22',
                'title' => 'student_access',
            ],
            [
                'id'    => '23',
                'title' => 'book_date_create',
            ],
            [
                'id'    => '24',
                'title' => 'book_date_edit',
            ],
            [
                'id'    => '25',
                'title' => 'book_date_show',
            ],
            [
                'id'    => '26',
                'title' => 'book_date_delete',
            ],
            [
                'id'    => '27',
                'title' => 'book_date_access',
            ],
            [
                'id'    => '28',
                'title' => 'excel_report_create',
            ],
            [
                'id'    => '29',
                'title' => 'excel_report_edit',
            ],
            [
                'id'    => '30',
                'title' => 'excel_report_show',
            ],
            [
                'id'    => '31',
                'title' => 'excel_report_delete',
            ],
            [
                'id'    => '32',
                'title' => 'excel_report_access',
            ],
            [
                'id'    => '33',
                'title' => 'system_operation_access',
            ],
            [
                'id'    => '34',
                'title' => 'location_create',
            ],
            [
                'id'    => '35',
                'title' => 'location_edit',
            ],
            [
                'id'    => '36',
                'title' => 'location_show',
            ],
            [
                'id'    => '37',
                'title' => 'location_delete',
            ],
            [
                'id'    => '38',
                'title' => 'location_access',
            ],
            [
                'id'    => '39',
                'title' => 'available_date_create',
            ],
            [
                'id'    => '40',
                'title' => 'available_date_edit',
            ],
            [
                'id'    => '41',
                'title' => 'available_date_show',
            ],
            [
                'id'    => '42',
                'title' => 'available_date_delete',
            ],
            [
                'id'    => '43',
                'title' => 'available_date_access',
            ],
            [
                'id'    => '44',
                'title' => 'module_access',
            ],
            [
                'id'    => '45',
                'title' => 'module_create',
            ],
            [
                'id'    => '46',
                'title' => 'module_edit',
            ],
            [
                'id'    => '47',
                'title' => 'module_show',
            ],
            [
                'id'    => '48',
                'title' => 'module_delete',
            ],
            [
                'id'    => '49',
                'title' => 'conductor_access',
            ],
            [
                'id'    => '50',
                'title' => 'conductor_create',
            ],
            [
                'id'    => '51',
                'title' => 'conductor_edit',
            ],
            [
                'id'    => '52',
                'title' => 'conductor_show',
            ],
            [
                'id'    => '53',
                'title' => 'conductor_delete',
            ],
            [
                'id'    => '54',
                'title' => 'book_date_status',
            ],
            [
                'id'    => '55',
                'title' => 'payment_create',
            ],
            [
                'id'    => '56',
                'title' => 'available_date_status',
            ],
        ];

        Permission::insert($permissions);
    }
}
