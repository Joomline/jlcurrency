<?php
 /**
 * @package mod_jlcurrency
 * @author Zhukov Artem (artem@joomline.ru)
 * @version 2.5
 * @copyright (C) 2012 by JoomLine (http://www.joomline.net)
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 *
*/
?>
<style>
.curContainer {overflow: auto;width: <?php echo $params->get('jlwidth');?>px;}
.curr {background: none repeat scroll 0 0 #FFFFFF;font: 0.8em "Times New Roman",Times,serif;}
.indexes {margin: 0;padding: 0;position: relative;}
.curContainer .curr .red {color: #FF0000;}
</style>
<div class="curContainer">
<table width="100%" class="curr">
<tr>
<td width="50%" nowrap="nowrap"><b><?php echo JText::_('MOD_JLCURRENCY') ?>&nbsp;</b></td>
<td width="10%"><b><?php echo JText::_('MOD_JLCURRENCY_DATA') ?></b></td>
<td width="20%" align="right"><b><?php echo JText::_('MOD_JLCURRENCY_CB') ?></b></td>
</tr>
<? foreach ($data as $curr) {  ?>
  <tr >
  <td><div class="indexes red"><i></i><span title="<?echo $curr['Name'];?>" alt="<?echo $curr['Name'];?>"><?php echo JText::_('MOD_JLCURRENCY_QV') ?><?echo $curr['CharCode'];?></a></span></div></td>
  <td><?echo $curr['Date'];?></td>
  <td align="right"><?echo $curr['Value'];?></td>
  </tr>
<? } ?>
</tr></table></div>
<div style="text-align: right;">
    <a href="http://joomline.net" target="_blank" style="text-decoration:none; color: #c0c0c0; font-family: arial,helvetica,sans-serif; font-size: 5pt; ">Joomline.net</a>
</div>
