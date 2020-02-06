<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('student_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-address-card">

                        </i>
                        <span>{{ trans('cruds.studentManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('student_access')
                            <li class="{{ request()->is('admin/students') || request()->is('admin/students/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.students.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.student.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('book_date_access')
                            <li class="{{ request()->is('admin/book-dates') || request()->is('admin/book-dates/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.book-dates.index") }}">
                                    <i class="fa-fw fas fa-calendar-alt">

                                    </i>
                                    <span>{{ trans('cruds.bookDate.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('excel_report_access')
                            <li class="{{ request()->is('admin/excel-reports') || request()->is('admin/excel-reports/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.excel-reports.pending") }}">
                                    <i class="fa-fw far fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.excelReportForPending.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('excel_report_access')
                            <li class="{{ request()->is('admin/excel-reports') || request()->is('admin/excel-reports/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.excel-reports.approved") }}">
                                    <i class="fa-fw far fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.excelReportForApproved.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('system_operation_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cog">

                        </i>
                        <span>{{ trans('cruds.systemOperation.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('location_access')
                            <li class="{{ request()->is('admin/locations') || request()->is('admin/locations/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.locations.index") }}">
                                    <i class="fa-fw fas fa-map-marker-alt">

                                    </i>
                                    <span>{{ trans('cruds.location.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('module_access')
                            <li class="{{ request()->is('admin/modules') || request()->is('admin/modules/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.modules.index") }}">
                                    <i class="fa-fw fas fa-check-circle">

                                    </i>
                                    <span>{{ trans('cruds.module.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('conductor_access')
                            <li class="{{ request()->is('admin/conductors') || request()->is('admin/conductors/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.conductors.index") }}">
                                    <i class="fa-fw fas fa-hand-pointer">

                                    </i>
                                    <span>{{ trans('cruds.conductor.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('available_date_access')
                            <li class="{{ request()->is('admin/available-dates') || request()->is('admin/available-dates/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.available-dates.index") }}">
                                    <i class="fa-fw far fa-calendar-alt">

                                    </i>
                                    <span>{{ trans('cruds.availableDate.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>