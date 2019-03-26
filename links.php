<?php
/**
 * 链接
 *
 * @package custom
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main">
<div class="breadcrumbs">
<a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo; <?php $this->title() ?>
</div>
<article class="post">
<div class="post-content">

<ul class="links">
<?php Links('',1); ?>
</ul>

<?php $this->content(); ?>

</div>
</article>
<?php $this->need('comments.php'); ?>
</div>

<?php $this->need('footer.php'); ?>