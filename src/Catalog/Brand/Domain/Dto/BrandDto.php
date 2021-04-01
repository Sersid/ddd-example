<?php
declare(strict_types=1);

namespace App\Catalog\Brand\Domain\Dto;

use App\Kernel\Domain\Dto\Dto;

class BrandDto extends Dto
{
    public int $id;
    public string $name;
    public ?string $description;
}
