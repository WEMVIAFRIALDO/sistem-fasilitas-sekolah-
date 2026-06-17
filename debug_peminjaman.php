<?php

require __DIR__ . '/vendor/autoload.php';

use App\Models\Peminjaman;

$q = Peminjaman::where('status', 'Dipinjam');

echo 'class=' . get_class($q) . PHP_EOL;
echo 'hasCount=' . (method_exists($q, 'count') ? 'yes' : 'no') . PHP_EOL;

try {
    echo 'count=' . $q->count() . PHP_EOL;
} catch (Throwable $e) {
    echo 'error=' . $e->getMessage() . PHP_EOL;
}
