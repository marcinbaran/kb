<div class="row">
    <div class="col-md-6">
        <?php $rows = $function->search($_GET['szukaj'], $_GET['by']); ?>
    </div>
    <div class="col-md-6">
        <?php
            if(isset($_GET['more'])){
                $function->show_more($_GET['by'], $_GET['more']);
            }
        ?>
    </div>
</div>