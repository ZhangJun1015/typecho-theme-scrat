<?php
/**
 * Scrat - 斯克莱特，冰河世纪电影里为了一颗松果拼死拼活，造成冰河时代天崩地裂，大陆漂移的小松鼠。
 * 始终如一，砥砺前行
 * @package Scrat
 * @author Sirit
 * @version 0.1
 * @link http://www.sirit.com.cn/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div class="col-mb-12 col-8" id="main" role="main">
 <?php while($this->next()): ?>
  <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
   <h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
     <ul class="post-meta">
      <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
      <li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
      <li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
      <li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?></a></li>
     </ul>
     <div class="post-content" itemprop="articleBody">

<?php if (postThumb($this)): ?>
   <div class="thumb"><?php echo postThumb($this); ?></div>
   <div class="zhaiyao"><?php $this->excerpt(250, ''); ?></div>
 <?php else: ?>
   <p><?php $this->excerpt(250, ''); ?></p>
 <?php endif; ?>

</div>
   </article>
  <?php endwhile; ?>

  <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>