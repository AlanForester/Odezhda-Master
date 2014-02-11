<?php


class LinkPager extends CLinkPager {


    public function init()
    {
        if($this->nextPageLabel===null)
            $this->nextPageLabel=Yii::t('yii','&gt;');
        if($this->prevPageLabel===null)
            $this->prevPageLabel=Yii::t('yii','&lt;');
        if($this->firstPageLabel===null)
            $this->firstPageLabel=Yii::t('yii','&lt;&lt; First');
        if($this->lastPageLabel===null)
            $this->lastPageLabel=Yii::t('yii','Last &gt;&gt;');
        if(!isset($this->htmlOptions['id']))
            $this->htmlOptions['id']=$this->getId();
        if(!isset($this->htmlOptions['class']))
            $this->htmlOptions['class']='yiiPager';
    }

    protected function createPageButtons()
    {
        if(($pageCount=$this->getPageCount())<=1)
            return array();

        list($beginPage,$endPage)=$this->getPageRange();
        $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons=array();

        // first page
        $buttons[]=$this->createPageButton('<<',0,'',$currentPage<=0,false);

        // prev page
        if(($page=$currentPage-1)<0)
            $page=0;
        $buttons[]=$this->createPageButton($this->prevPageLabel,$page,'<',$currentPage<=0,false);

        // internal pages
        for($i=$beginPage;$i<=$endPage;++$i)
            $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

        // next page
        if(($page=$currentPage+1)>=$pageCount-1)
            $page=$pageCount-1;
        $buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);

        // last page
        $buttons[]=$this->createPageButton(">>",$pageCount-1,'',$currentPage>=$pageCount-1,false);

        return $buttons;
    }
}