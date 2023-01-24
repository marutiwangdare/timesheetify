<?php
defined('ABSPATH') or wp_die();

global $wpdb;
$user_id    = sanitize_text_field( $_GET['user_id'] );
$table      = $wpdb->base_prefix . "btpjy_members";
$members    = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE user_id = %s", $user_id ) );
$department = $members->department;
?>
<div class="content d-flex flex-column flex-column-fluid add-member-panel" id="btpjy_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="btpjy_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php esc_html_e( 'Member Profile', 'projectify' ); ?></h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-300"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="btpjy_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="btpjy_subheader_total"><?php esc_html_e( 'You can view user details', 'projectify' ); ?></span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Button-->
                <a href="<?php echo esc_attr( esc_url( $_SERVER['HTTP_REFERER'] ) ); ?>" class="btn btn-white btn-hover-bg-white btn-hover-text-primary font-weight-bold font-weight-bolder font-size-sm px-5 btn-fixed-height"><?php esc_html_e( 'Back', 'projectify' ); ?></a>
                <!--end::Button-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Profile Overview-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="btpjy_profile_aside">
                    <!--begin::Nav Panels Wizard 2-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body pt-4 custom-padding-card">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline">
                                    <a href="#" class="btn btn-icon-primary btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="svg-icon svg-icon-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1">
                                                    <rect x="14" y="9" width="6" height="6" rx="3" fill="black"></rect>
                                                    <rect x="3" y="9" width="6" height="6" rx="3" fill="black" fill-opacity="0.7"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover py-5">
                                            <li class="navi-item">
                                                <a href="<?php echo esc_url( 
                                                add_query_arg( 
                                                array(
                                                'action'  => 'edit',
                                                'user_id' => $members->user_id,
                                                ), admin_url( 'admin.php?page=projectify-pro-members' ) ) ); ?>" class="navi-link">
                                                    <span class="navi-icon">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                                                    <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                                                                    <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    <span class="navi-text"><?php esc_html_e( 'Edit', 'projectify' ); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-60 symbol-xxl-90 mr-5 align-self-start align-self-xxl-center">
                                    <div class="symbol-label" style="background-image:url('<?php echo esc_attr( btpjy_Helper::btpjy_value_check( $members->picture ) ); ?>');"></div>
                                    <i class="symbol-badge bg-success"></i>
                                </div>
                                <div>
                                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?php echo esc_html( btpjy_Helper::btpjy_value_check( $members->name ) ); ?></a>
                                    <div class="text-muted"><?php echo esc_html( btpjy_Helper::btpjy_value_check( $members->job_title ) ); ?></div>
                                    <div class="text-muted"><?php echo esc_html( $department ); ?></div>
                                </div>
                            </div>
                            </br>
                            <?php if ( ! empty ( $members->facebook ) || ! empty ( $members->skype ) || ! empty ( $members->email ) ) { ?>
                            <div class="mb-0">
                                <?php if ( ! empty ( $members->facebook ) ) { ?>
                                <a href="https://www.facebook.com/profile.php?id=<?php echo esc_attr( $members->facebook ); ?>" class="btn btn-icon btn-circle btn-light-facebook mr-2">
                                    <i class="fab fa-facebook-f icon-1x"></i>
                                </a>
                                <?php } if ( ! empty ( $members->skype ) ) { ?>
                                <a href="https://join.skype.com/invite/<?php echo esc_attr( $members->skype ); ?>" class="btn btn-icon btn-circle btn-light-twitter mr-2">
                                    <i class="fab fa-skype icon-1x"></i>
                                </a>
                                <?php } if ( ! empty ( $members->email ) ) { ?>
                                <a href="mailto:<?php echo esc_attr( $users->email ); ?>" class="btn btn-icon btn-circle btn-light-google">
                                    <i class="far fa-envelope icon-1x"></i>
                                </a>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <!--end::User-->
                            <!--begin::Contacts-->
                            <div class="py-8">
                                <?php if ( ! empty ( $members->phone ) ) { ?>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="flex-shrink-0 mr-2">
                                        <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z" fill="#000000"></path>
                                                    <path d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="text-muted font-weight-bold"><?php echo esc_html( btpjy_Helper::btpjy_value_check( $members->phone ) ); ?></span>
                                </div>
                                <?php } if ( ! empty ( $members->email ) ) { ?>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="flex-shrink-0 mr-2">
                                        <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold"><?php echo esc_html( btpjy_Helper::btpjy_value_check( $members->email ) ); ?></a>
                                </div>
                                <?php } if ( ! empty ( $members->address1 ) || ! empty ( $members->address2 ) ) { ?>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="flex-shrink-0 mr-2">
                                        <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                        <?php echo esc_html( $members->address1.' '.$members->address2 ); ?>
                                    </a>
                                </div>
                                <?php } if ( ! empty ( $members->city ) || ! empty ( $members->state ) || ! empty ( $members->country ) ) { ?>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="flex-shrink-0 mr-2">
                                        <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                        <?php echo esc_html( $members->city.', '.$members->state.', '.$members->country ); ?>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Nav Panels Wizard 2-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8 member-col-8">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::List Widget 1-->
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-6">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php esc_html_e( 'Recent Projects', 'projectify' ); ?></span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-5">
                                    <?php 
                                    $all_projects = btpjy_Helper::btpjy_get_projects();
                                    $all_projects = array_reverse( $all_projects );
                                    $sno = 1;
                                    if ( ! empty ( $all_projects ) ) {
                                    foreach ( $all_projects as $tkey => $p_value ) {
                                        $member_arr = btpjy_Helper::btpjy_get_team_member( $p_value->teams );
                                        if ( in_array( $user_id, $member_arr ) && $sno < 7 ) {
                                            $client      = btpjy_Helper::btpjy_client_id_info( $p_value->client );
                                            $client_name = $client->name;

                                            if ( $p_value->status == 'no-progress' ) {
                                                $progress = 'No Progress';
                                                $p_class  = 'text-primary';
                                            } elseif ( $p_value->status == 'processing' ) {
                                                $progress = 'Processing';
                                                $p_class  = 'text-warning';
                                            } else {
                                                $progress = 'Completed';
                                                $p_class  = 'text-success';
                                            }

                                            $project_second = explode( ' ', $p_value->name );

                                            if ( null !== $project_second[1] && ! empty ( $project_second[1] ) ) {
                                                $psecond = $project_second[1];
                                            }
                                    ?>
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-6">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35 symbol-light-info flex-shrink-0 mr-3">
                                            <span class="symbol-label font-weight-bolder font-size-lg"><?php echo esc_html( btpjy_Helper::btpjy_get_initials( $p_value->name, $psecond ) ); ?></span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Content-->
                                        <div class="d-flex flex-wrap flex-row-fluid">
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column pr-5 flex-grow-1">
                                                <a href="<?php echo esc_url( 
                                                add_query_arg( 
                                                array(
                                                'action'  => 'view',
                                                'row_id'  => $p_value->id,
                                                ), admin_url( 'admin.php?page=projectify-pro-projects' ) ) ); ?>" class="text-dark text-hover-primary font-weight-bolder font-size-lg">
                                                    <?php echo esc_html( $p_value->name ); ?>
                                                </a>
                                                <span class="font-size-sm font-weight-bolder"><?php esc_html_e( 'Client:- ', 'projectify' ); ?> <?php echo esc_html( $client_name ); ?></span>
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center py-2">
                                                <!--begin::Label-->
                                                <span class="<?php echo esc_attr( $p_class ); ?> font-weight-bolder font-size-sm pr-6"><?php echo esc_html( $progress ); ?></span>
                                                <!--end::Label-->
                                                <!--begin::Btn-->
                                                <a href="<?php echo esc_url( 
                                                add_query_arg( 
                                                array(
                                                'action'  => 'view',
                                                'row_id'  => $p_value->id,
                                                ), admin_url( 'admin.php?page=projectify-pro-projects' ) ) ); ?>" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999)"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <!--end::Btn-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <?php $sno++; } } }
                                        if ( $sno == 1 ) {
                                          echo esc_html__( 'No projects assignned yet!', 'projectify' );  
                                        }
                                    ?>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 1-->
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!--begin::List Widget 1-->
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-6">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php esc_html_e( 'Recent Assigneed Tasks', 'projectify' ); ?></span>
                                    </h3>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-5">
                                    <?php 
                                    $all_tasks = btpjy_Helper::btpjy_get_tasks();
                                    $all_tasks = array_reverse( $all_tasks );
                                    $sno = 1;
                                    if ( ! empty ( $all_tasks ) ) {
                                    foreach ( $all_tasks as $tkey => $p_value ) {
                                        $member_arr = unserialize( $p_value->assignee );
                                        if ( in_array( $user_id, $member_arr ) && $sno < 7 ) {
                                            $project_data = btpjy_Helper::btpjy_project_info( $p_value->project_id );
                                            $project_name = $project_data->name;

                                            if ( $p_value->status == 'Pending' ) {
                                                $progress = 'Pending';
                                                $p_class  = 'text-primary';
                                            } elseif ( $p_value->status == 'Processing' ) {
                                                $progress = 'Processing';
                                                $p_class  = 'text-warning';
                                            } else {
                                                $progress = 'Completed';
                                                $p_class  = 'text-success';
                                            }

                                            $task_second = explode( ' ', $p_value->name );

                                            if ( null !== $task_second[1] && ! empty ( $task_second[1] ) ) {
                                                $tsecond = $task_second[1];
                                            }
                                    ?>
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-6">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35 symbol-light-info flex-shrink-0 mr-3">
                                            <span class="symbol-label font-weight-bolder font-size-lg"><?php echo esc_html( btpjy_Helper::btpjy_get_initials( $p_value->name, $tsecond ) ); ?></span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Content-->
                                        <div class="d-flex flex-wrap flex-row-fluid">
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column pr-5 flex-grow-1">
                                                <a href="<?php echo esc_url( 
                                                add_query_arg( 
                                                array(
                                                'action'  => 'view',
                                                'row_id'  => $p_value->id,
                                                ), admin_url( 'admin.php?page=projectify-pro-tasks' ) ) ); ?>" class="text-dark text-hover-primary font-weight-bolder font-size-lg">
                                                    <?php echo esc_html( $p_value->name ); ?>
                                                </a>
                                                <span class="font-size-sm font-weight-bolder"><?php esc_html_e( 'Project:- ', 'projectify' ); ?> <?php echo esc_html( $project_name ); ?></span>
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center py-2">
                                                <!--begin::Label-->
                                                <span class="<?php echo esc_attr( $p_class ); ?> font-weight-bolder font-size-sm pr-6"><?php echo esc_html( $progress ); ?></span>
                                                <!--end::Label-->
                                                <!--begin::Btn-->
                                                <a href="<?php echo esc_url( 
                                                add_query_arg( 
                                                array(
                                                'action'  => 'view',
                                                'row_id'  => $p_value->id,
                                                ), admin_url( 'admin.php?page=projectify-pro-tasks' ) ) ); ?>" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999)"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </a>
                                                <!--end::Btn-->
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Item-->
                                    <?php $sno++; } } }
                                        if ( $sno == 1 ) {
                                          echo esc_html__( 'No task assignned yet!', 'projectify' );  
                                        }
                                    ?>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::List Widget 1-->
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Overview-->
        </div>
        <!--end::Container-->
    </div>
</div>