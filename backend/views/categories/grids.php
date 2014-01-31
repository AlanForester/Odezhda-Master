<?php
/**
 * Created by PhpStorm.
 * User: dmitri
 * Date: 30.01.14
 * Time: 20:48
 */
//print_r($gridDataProvider->data);exit;
$result='';
foreach ($gridDataProvider->data as $element) {
 $result.='<tr class="treegrid-'.$element['id'].' treegrid-parent-'.$element['parent_id'].'"><td><span class="treegrid-expander treegrid-expander-collapsed"></span><a data-pk="'.$element['id'].'" rel="name" href="#" class="editable editable-click">'.$element['name'].'</a></td><td>'.$element['parent_id'].'</td><td>'.$element['childCount'].'</td><td>'.$element['id'].'</td><td width="50px" class="action-buttons"><a href="#" rel="tooltip" onclick="js: (function(){
                                bootbox.alert(&quot;Здесь должно быть модальное окно с просмотром всей информации записи, без возможности редактирования&quot;);})()" title="" class="bigger-130" data-original-title="Просмотр"><i class="icon-eye-open"></i></a> <a href="#" rel="tooltip" title="" class="green bigger-130" data-original-title="Изменить"><i class="icon-pencil"></i></a> <a href="#" rel="tooltip" title="" class="red bigger-130" data-original-title="Удалить"><i class="icon-trash"></i></a></td></tr>';
}
echo($result);
//<tr class="treegrid-932 hasChildren treegrid-collapsed"><td><span class="treegrid-expander treegrid-expander-collapsed"></span><a data-pk="932" rel="name" href="#" class="editable editable-click">Аксессуары</a></td><td>0</td><td>35</td><td>932</td><td width="50px" class="action-buttons"><a href="#" rel="tooltip" onclick="js: (function(){
//                                bootbox.alert(&quot;Здесь должно быть модальное окно с просмотром всей информации записи, без возможности редактирования&quot;);
//                            })()" title="" class="bigger-130" data-original-title="Просмотр"><i class="icon-eye-open"></i></a> <a href="#" rel="tooltip" title="" class="green bigger-130" data-original-title="Изменить"><i class="icon-pencil"></i></a> <a href="#" rel="tooltip" title="" class="red bigger-130" data-original-title="Удалить"><i class="icon-trash"></i></a></td></tr>