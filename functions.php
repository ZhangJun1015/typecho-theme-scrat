<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    
}

function img_postthumb($cid) {
   $db = Typecho_Db::get();
   $rs = $db->fetchRow($db->select('table.contents.text')
       ->from('table.contents')
       ->where('table.contents.cid=?', $cid)
       ->order('table.contents.cid', Typecho_Db::SORT_ASC)
       ->limit(1));

   preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $rs['text'], $thumbUrl);  //通过正则式获取图片地址
   $img_src = $thumbUrl[1][0];  //将赋值给img_src
   $img_counter = count($thumbUrl[0]);  //一个src地址的计数器

   switch ($img_counter > 0) {
       case $allPics = 1:
           echo $img_src;  //当找到一个src地址的时候，输出缩略图
           break;
       default:
           echo "";  //没找到(默认情况下)，不输出任何内容
   };
}

function postThumb($obj) {
	$thumb = $obj->fields->thumb;
	if (!$thumb) {
		return false;
	}
	if (is_numeric($thumb)) {
		preg_match_all('/<img.*?src="(.*?)".*?[\/]?>/i', $obj->content, $matches);
		if (isset($matches[1][$thumb-1])) {
			$thumb = $matches[1][$thumb-1];
		} else {
			return false;
		}
	}
	if (Helper::options()->AttUrlReplace) {
		$thumb = UrlReplace($thumb);
	}
	return '<img src="'.$thumb.'" />';
}


function themeFields($layout) {
	$thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('在这里填入一个图片 URL 地址, 以添加本文的缩略图，若填入纯数字，例如 <b>3</b> ，则使用文章第三张图片作为缩略图（对应位置无图则不显示缩略图），留空则默认不显示缩略图'));
	$thumb->input->setAttribute('class', 'w-100');
	$layout->addItem($thumb);
	
}

/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

