<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
  
    $ICPbeian = new Typecho_Widget_Helper_Form_Element_Text('ICPbeian', NULL, NULL, _t('ICP备案号'), _t('在这里输入ICP备案号,留空则不显示'));
    $form->addInput($ICPbeian);  
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


function Links($sorts = NULL, $icon = 0) {
	$db = Typecho_Db::get();
	$link = NULL;
	$list = NULL;
	$page_links = FindContents('links.php', 'order', 'a');
	if ($page_links) {
		$exist = $db->fetchRow($db->select()->from('table.fields')
			->where('cid = ? AND name = ?', $page_links[0]['cid'], 'links'));
		if (empty($exist)) {
			$db->query($db->insert('table.fields')
				->rows(array(
					'cid'           =>  $page_links[0]['cid'],
					'name'          =>  'links',
					'type'          =>  'str',
					'str_value'     =>  NULL,
					'int_value'     =>  0,
					'float_value'   =>  0
				)));
			return NULL;
		}
		$list = $exist['str_value'];
	}
	if ($list) {
		$list = explode("\r\n", $list);
		foreach ($list as $val) {
			list($name, $url, $description, $logo, $sort) = explode(',', $val);
			if ($sorts) {
				$arr = explode(',', $sorts);
				if ($sort && in_array($sort, $arr)) {
					$link .= '<li><a'.($url ? ' href="'.$url.'"' : '').($icon==1&&$url ? ' class="l_logo"' : '').' title="'.$description.'" target="_blank">'.($icon==1&&$url ? '<img src="'.($logo ? $logo : rtrim($url, '/').'/favicon.ico').'" onerror="erroricon(this)">' : '').'<span>'.($url ? $name : '<del>'.$name.'</del>').'</span></a></li>'."\n";
				}
			} else {
				$link .= '<li><a'.($url ? ' href="'.$url.'"' : '').($icon==1&&$url ? ' class="l_logo"' : '').' title="'.$description.'" target="_blank">'.($icon==1&&$url ? '<img src="'.($logo ? $logo : rtrim($url, '/').'/favicon.ico').'" onerror="erroricon(this)">' : '').'<span>'.($url ? $name : '<del>'.$name.'</del>').'</span></a></li>'."\n";
			}
		}
	}
	echo $link ? $link : '<li>暂无链接</li>'."\n";
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

