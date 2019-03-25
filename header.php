<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="//cdnjscn.b0.upaiyun.com/libs/normalize/2.1.3/normalize.min.css">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('grid.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">

    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

<header id="header" class="clearfix">
    <div class="container">
        <div class="row">

<div id="logoimg" ><a href="<?php $this->options->siteUrl(); ?>"><img src="<?php $this->options->logoUrl() ?>" title="<?php $this->options->title() ?>" alt="<?php $this->options->title() ?>" /></a></div>          

<div class="sitedesc"><?php $this->options->description() ?></div>

<div id="fenlei"><?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?></div>

<div class="site-search col-3 kit-hidden-tb">
    <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
    <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
    <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
    <button type="submit" class="submit"><?php _e('搜索'); ?></button>
    </form>
</div>

<div id="sixlogos">
<a  href="/index.php/guidang.html" ><img class="siximgs" src="http://www.sirit.com.cn/6achive.png" title="归档"/></a>
<a  href="/index.php" ><img class="siximgs" src="http://www.sirit.com.cn/6guestbook.png" title="留言"/></a>
<a  href="/index.php" ><img class="siximgs" src="http://www.sirit.com.cn/6links.png" title="友链"/></a>
<a  href="/index.php/start-page.html" ><img class="siximgs" src="http://www.sirit.com.cn/6about.png" title="关于"/></a>
<a target="_blank" href="https://github.com/ZhangJun1015" ><img class="siximgs" src="http://www.sirit.com.cn/6github.png" title="Github"/></a>
<a target="_blank" href="<?php $this->options->feedUrl(); ?>" ><img class="siximgs" src="http://www.sirit.com.cn/6rss.png" title="RSS"/></a>
</div>

<div id="footer">&copy;<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> | <a href="http://www.miitbeian.gov.cn" target="_blank" > 粤ICP备18101800号</a>  Powered by <?php _e('<a href="http://www.typecho.org">Typecho</a> & <a href="/">Scrat</a>'); ?></div>
            
        </div><!-- end .row -->
    </div>
</header><!-- end #header -->
<div id="body">
    <div class="maincontainer">
        <div class="row">

    
    