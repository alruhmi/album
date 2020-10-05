<? require 'template-parts/header.php';?>
<div class="container">
<? if ($items):?>
    <? foreach ($items as $item):?>

    <div class="border border-dark mt-3">
        <p><?=$item['name']?></p>
        <a href="tel:<?$item['phone'];?>"><?=$item['phone']?></a>
        <div class="row">
        <? if ($item['photos']):?>
            <? foreach ($item['photos'] as $photo):?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="<?=$photo?>" style="height: 225px; width: 100%; display: block;">
                    </div>
                </div>
            <? endforeach;?>
        <?endif;?>
        </div>
    </div>
    <? endforeach;?>
<?endif;?>

    <button type="button" class="btn btn-primary mt-3" onclick="showMore()">Показать еще</button>
</div>

<? require 'template-parts/footer.php';?>
