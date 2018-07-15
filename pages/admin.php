<?php
/**
 * Teampass - a collaborative passwords manager
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @category  Teampass
 * @package   Login.php
 * @author    Nils Laumaillé <nils@teampass.net>
 * @copyright 2009-2018 Nils Laumaillé
* @license   https://spdx.org/licenses/GPL-3.0-only.html#licenseText GPL-3.0
 * @version   GIT: <git_id>
 * @link      http://www.teampass.net
 */

if (isset($_SESSION['CPM']) === false || $_SESSION['CPM'] !== 1
    || isset($_SESSION['user_id']) === false || empty($_SESSION['user_id']) === true
    || isset($_SESSION['key']) === false || empty($_SESSION['key']) === true
) {
    die('Hacking attempt...');
}

// Load config
if (file_exists('../includes/config/tp.config.php') === true) {
    include_once '../includes/config/tp.config.php';
} elseif (file_exists('./includes/config/tp.config.php') === true) {
    include_once './includes/config/tp.config.php';
} else {
    throw new Exception("Error file '/includes/config/tp.config.php' not exists", 1);
}

/* do checks */
require_once $SETTINGS['cpassman_dir'].'/sources/checks.php';
if (checkUser($_SESSION['user_id'], $_SESSION['key'], "admin", $SETTINGS) === false) {
    $_SESSION['error']['code'] = ERR_NOT_ALLOWED;
    include $SETTINGS['cpassman_dir'].'/error.php';
    exit();
}

// Load template
require_once $SETTINGS['cpassman_dir'].'/sources/main.functions.php';

// get current statistics items
$statistics_items = array();
if (isset($SETTINGS['send_statistics_items'])) {
    $statistics_items = array_filter(explode(";", $SETTINGS['send_statistics_items']));
}

?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo langHdl('admin');?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?page=admin"><?php echo langHdl('admin');?></a></li>
                        <li class="breadcrumb-item active"><?php echo langHdl('admin_main');?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-bullhorn"></i>
                                <?php echo langHdl('communication_means');?>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5><i class="fa fa-globe fa-lg"></i>&nbsp;</h5>

                                <p><a target="_blank" href="#" class="link"><?php echo langHdl('website_canal');?></a></p>
                            </div>
                            <div class="callout callout-info">
                                <h5><i class="fa fa-book fa-lg"></i>&nbsp;<?php echo langHdl('documentation_canal');?></h5>

                                <p><a target="_blank" href="https://teampass.readthedocs.org">ReadTheDoc</a></p>
                            </div>
                            <div class="callout callout-info">
                                <h5><i class="fa fa-github fa-lg"></i>&nbsp;<?php echo langHdl('bug_canal');?></h5>

                                <p><a target="_blank" href="https://github.com/nilsteampassnet/TeamPass/issues">Github</a></p>
                            </div>
                            <div class="callout callout-info">
                                <h5><i class="fa fa-lightbulb-o fa-lg"></i>&nbsp;<?php echo langHdl('feature_request_canal');?></h5>

                                <p><a target="_blank" href="https://teampass.userecho.com">User>Echo</a></p>
                            </div>
                            <div class="callout callout-info">
                                <h5><i class="fa fa-reddit-alien fa-lg"></i>&nbsp;<?php echo langHdl('feature_support_canal');?></h5>

                                <p><a target="_blank" href="https://www.reddit.com/r/TeamPass">Reddit</a></p>
                            </div>
                            <div class="callout callout-info">
                                <h5><i class="fa fa-beer fa-lg"></i>&nbsp;<?php echo langHdl('consider_a_donation');?></h5>

                                <p><a target="_blank" href="https://teampass.net/donation"><?php echo langHdl('more_information');?></a></p>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-warning"></i>
                                <?php echo langHdl('changelog');?>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            // Display the readme file
                            $Fnm = "changelog.txt";
                            if (file_exists($Fnm)) {
                                $tab = file($Fnm);
                                if ($tab !== false) {
                                    $show = false;
                                    $cnt = 0;
                                    foreach ($tab as $cle => $val) {
                                        if ($cnt < 19) {
                                            echo $val."<br />";
                                            $cnt++;
                                        } elseif ($cnt === 19) {
                                            echo '...<br /><br /><b><a href="changelog.txt" target="_blank"><span class="fa fa-book"></span>&nbsp;'.langHdl('readme_open').'</a></b>';
                                            break;
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->





