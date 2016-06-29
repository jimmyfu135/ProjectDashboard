<?php
$this->registerCssFile('@web/css/public.css');
?>
<div class="inner-container">
    <?=Html::beginForm('', 'post' , ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal' , 'id' =>'addForm' ])?>
    <?=$this->render('_form' , ['model' => $model,'categorys' => $categorys,'taskstatus'=>$taskstatus]);?>
    <div class="form-group">
        <div style="margin-top:10px" class="col-sm-10 col-sm-offset-8 ">
            <a href="<?="javascript:submitDelProjPlan('$model->id')"?>" class="btn btn-primary">删除</a>
            <a href="<?="javascript:submitEditProjPlan('$model->id')"?>" class="btn btn-primary">提交</a>
            <a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
        </div>
    </div>
    <?=Html::endForm();?>
</div>
