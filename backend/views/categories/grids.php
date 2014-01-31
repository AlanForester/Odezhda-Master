<?php

/**
 * Created by PhpStorm.
 * User: dmitri
 * Date: 30.01.14
 * Time: 20:48
 */
//todo переделать под виджет
$result='';
foreach ($gridDataProvider->data as $n=>$element) {
    $css='treegrid-'.$element['id'].' ';
    if (!empty($element['childCount'])){
        $css.='hasChildren ';
    }
    if ($element['parent_id']!='0'){
        $css.=' treegrid-parent-'.$element['parent_id'];
    }

 $result.='<tr class=" '.$css.' ">
 <td class="checkbox-column"><input type="checkbox" name="gridids[]" id="whgrid_c'.$element['parent_id'].'_'.$n.'" value="'.$element['id'].'" class="select-on-check"><label><input type="checkbox" name="gridids[]" id="whgrid_c0_0" value="'.$element['id'].'" class="select-on-check"><span class="lbl"></span></label></td>
 <td><span class="treegrid-expander treegrid-expander-collapsed"></span><a data-pk="'.$element['id'].'" rel="name" href="#" class="editable editable-click" data-original-title="" title="">'.$element['name'].'</a></td>
 <td>'.$element['parent_id'].'</td>
 <td>'.$element['childCount'].'</td>
 <td>'.$element['id'].'</td>
 <td width="50px" class="action-buttons"><a href="#" rel="tooltip" onclick="js: (function(){
      bootbox.alert(&quot;Здесь должно быть модальное окно с просмотром всей информации записи, без возможности редактирования&quot;);})()" title="" class="bigger-130" data-original-title="Просмотр"><i class="icon-eye-open"></i></a>
      <a href="'.Yii::app()->request->baseUrl.'/categories/edit/'.$element['id'].'/" rel="tooltip" title="" class="green bigger-130" data-original-title="Изменить"><i class="icon-pencil"></i></a>
      <a href="'.Yii::app()->request->baseUrl.'/categories/delete/'.$element['id'].'/" rel="tooltip" title="" class="red bigger-130" data-original-title="Удалить"><i class="icon-trash"></i></a>
 </td></tr>';
}
echo($result);