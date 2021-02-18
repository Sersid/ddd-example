<?php
declare(strict_types=1);

namespace Tests\Catalog\Application\AddProduct;

use App\Catalog\Application\AddProduct\AddProductCommand;
use App\Catalog\Application\AddProduct\AddProductCommandHandler;
use PHPUnit\Framework\TestCase;

class AddProductCommandHandlerTest extends TestCase
{
    public function testHandler()
    {
        $command = new AddProductCommand();
    }
}
