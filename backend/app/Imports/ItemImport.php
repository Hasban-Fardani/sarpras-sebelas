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
        $category_id = null;
        $category = Category::where('name', strtolower($row['kategori']))->first();
        if (!$category) {
            $category_id = Category::create(['name' => $row['kategori']])->id;
        } else {
            $category_id = $category->id;
        }

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
