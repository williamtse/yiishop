<?php
use yii\helpers\Url;
?>
<script>
    $(function(){
        var h = $(document).height()-103;
        $("#install_frame").css({'height':h});
    });
</script>
<iframe id="install_frame" src="<?=Url::toRoute(["module/install_frame",'package'=>$package,'full_name'=>$full_name])?>" 
         style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;" ></iframe>