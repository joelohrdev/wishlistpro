<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

final class ItemForm extends Form
{
    #[Validate(['required', 'string', 'min:2', 'max:255'])]
    public string $name = '';

    #[Validate(['nullable', 'image', 'max:1024'])]
    public ?TemporaryUploadedFile $image = null;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $size = '';

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $color = '';

    #[Validate(['nullable', 'url', 'max:255'])]
    public ?string $link = '';

    #[Validate(['nullable'])]
    public ?string $price = null;

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $store = '';

    #[Validate(['nullable', 'string', 'max:255'])]
    public string $priority = '';

    #[Validate(['nullable', 'string', 'max:255'])]
    public ?string $occasion = null;
}
