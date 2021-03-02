<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"D:\phpstudy_pro\WWW\docking\public/../application/admin\view\push_log\edit.html";i:1614650260;s:70:"D:\phpstudy_pro\WWW\docking\application\admin\view\layout\default.html";i:1611580233;s:67:"D:\phpstudy_pro\WWW\docking\application\admin\view\common\meta.html";i:1611580233;s:69:"D:\phpstudy_pro\WWW\docking\application\admin\view\common\script.html";i:1611580233;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Push_type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-push_type" data-rule="required" class="form-control selectpicker" name="row[push_type]">
                <?php if(is_array($pushTypeList) || $pushTypeList instanceof \think\Collection || $pushTypeList instanceof \think\Paginator): if( count($pushTypeList)==0 ) : echo "" ;else: foreach($pushTypeList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['push_type'])?$row['push_type']:explode(',',$row['push_type']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Trigger_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-trigger_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[trigger_time]" type="text" value="<?php echo $row['trigger_time']?datetime($row['trigger_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Push_data'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-push_data" data-rule="required" class="form-control " rows="5" name="row[push_data]" cols="50"><?php echo htmlentities($row['push_data']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sync_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($syncStatusList) || $syncStatusList instanceof \think\Collection || $syncStatusList instanceof \think\Paginator): if( count($syncStatusList)==0 ) : echo "" ;else: foreach($syncStatusList as $key=>$vo): ?>
            <label for="row[sync_status]-<?php echo $key; ?>"><input id="row[sync_status]-<?php echo $key; ?>" name="row[sync_status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['sync_status'])?$row['sync_status']:explode(',',$row['sync_status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sync_result'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-sync_result" data-rule="required" class="form-control " rows="5" name="row[sync_result]" cols="50"><?php echo htmlentities($row['sync_result']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sync_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sync_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[sync_time]" type="text" value="<?php echo $row['sync_time']?datetime($row['sync_time']):''; ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
