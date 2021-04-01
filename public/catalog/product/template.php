<?php
declare(strict_types=1);

/** @var ProductView $product */

use App\Catalog\Product\Domain\ReadModel\ProductView;

?>
<h1><?= $product->name() ?></h1>
<p><a href="<?= $product->url() ?>"><?= $product->code() ?></a></p>
<?php if ($product->hasDescription()) { ?>
    <div>
        <h4>Описание</h4>
        <p><?= $product->description() ?></p>
    </div>
<?php } ?>
<?php if ($product->hasBrand()) { ?>
    <div>
        <h4>Бренд</h4>
        <p>
            <a href="<?= $product->brand()->url() ?>"><?= $product->brand()->name() ?></a>
        </p>
    </div>
<?php } ?>
