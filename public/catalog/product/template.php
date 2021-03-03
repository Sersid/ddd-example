<?php
declare(strict_types=1);

use App\Catalog\Product\Domain\Entity\Product;

/** @var Product $product */
?>
<div>
    <h1><?= $product->getName()->toUpper()->htmlEntities() ?></h1>
    <div>
        <p>Наименование: <?= $product->getName() ?></p>
        <p>Цена: <?= $product->getPrice()->getFormatted() ?></p>
        <?php if ($product->getDescription()->isNotEmpty()) { ?>
        <p>Описание: <?= $product->getDescription() ?></p>
        <?php } ?>
    </div>
</div>
