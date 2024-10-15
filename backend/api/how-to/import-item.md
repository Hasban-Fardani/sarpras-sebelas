# Gimana Caranya import data barang dari excel atau csv?

1. Download package laravel excel, instruksinya bisa dilihat [disini](https://docs.laravel-excel.com/3.1/getting-started/installation.html)

2. buat class untuk import item dengan command:
```bash
php artisan make:import ItemImport 
```
3. isi kode file ItemImport dengan kode seperti berikut
```php
<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return Item|null
     */
    public function model(array $row)
    {
        // akan create category baru jika belum ada di database dan mengambil id atau codeya
        $category_id = null;
        $category = Category::where('name', strtolower($row['kategori']))->first();
        if (!$category) {
            $category_id = Category::create(['name' => $row['kategori']])->id;
        } else {
            $category_id = $category->id;
        }

        // Note: sesuaikan dengan kolom masing masing
        return new Item([
            'name' => $row['nama'],
            'merk' => $row['merek'],
            'type' => $row['jenis'],
            'size' => $row['ukuran'],
            'unit' => $row['satuan'],
            'price' => $row['harga'],
            'stock' => $row['stok'],
            'min_stock' => $row['min_stok'],
            'category_id' => $category_id,
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
```

4. buat controller baru atau anda bisa saja membuat method didalam kode berikut:
```php
$file = $request->file('file');
$filename = $file->getClientOriginalName();
$path = $file->storeAs('files', $filename, 'public');

// menggunakan queue agar tidak lemot
Excel::queueImport(new ItemImport, $path, 'public');
```

lalu tambahkan ke route seperti berikut (contoh)
```php
Route::post('item/import', ImportItemController::class);
```

## Catatan
- jika mendapatkan error seperti demikian

maka anda harus menjalankan perintah berikut
```
class \"league\\flysystem\\awss3v3\\portablevisibilityconverter\" not found
```
```bash
composer require league/flysystem-aws-s3-v3
```