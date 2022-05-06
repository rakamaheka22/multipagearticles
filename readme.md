# Multi Page Articles.
Ini adalah aplikasi demo dari research & development mengenai multi page article

## Local Deployment

Sebelum memulai, pastikan hal-hal berikut sudah terinstall:

- [Git](https://git-scm.com/)
- PHP >= 7.2
- Nginx atau Apache
- MySQL
- [Composer](https://getcomposer.org/)

Anda diharapkan sudah menyiapkan database dan user untuk digunakan oleh aplikasi.

> **Note:** Jika menggunakan OS Windows bisa pakai [laragon](https://laragon.org/download/) sebagai pengganti XAMPP.

### 1. Clone repository ke dalam directory server Anda.
```sh
git clone git@bitbucket.org:rollingglory/multipagearticles.git
```

### 2. Pindah ke directory aplikasi
```sh
cd multipagearticles
```

### 3. Buat file .env atau copy file .env.example dan rename file menjadi .env

```sh
cp .env.example .env
```

### 4. Install dependensi backend dengan composer

```sh
composer install
```

### 5. Generate application key

```sh
php artisan key:generate
```

### 6. Masukan kredensial mysql ke dalam file .env
```
// pada file .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_user_database
```

### 7. Migrate database

```sh
php artisan migrate
```

### 6. Seed database

```sh
php artisan db:seed
```

### 7. Symbolic link local storage

```sh
php artisan storage:link
```

### 8. Install dependensi frontend

```sh
npm install
```

### 9. Compile code frontend

```sh
npm run dev
```

### 10. Compile code frontend CMS
```sh
npm run dev:admin
```
---

## Setup Multi Page Articles Service

### 1. Gunakan class Trait `App\Services\Article\MultiPageArticles` pada model article

```
<?php

namespace App\Models;

use App\Services\Article\MultiPageArticles;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use MultiPageArticles;
}
```

### 2. Gunakan fungsi `paginateContent()` pada object article yang telah menggunakan service Mutli Page Articles

Hasil yang dikembalikan dari `paginateContent()` berupa instance dari `Illuminate\Pagination\LengthAwarePaginator`
```
<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class GetArticleContent extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string  $slug
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(string $slug, Request $request)
    {
        $page = $request->page ??= 1;
        $article = Article::where('slug', $slug)->firstOrFail();

        return $article->paginateContent((integer)$page);
    }
}
```

### 3. Customisasi nama field content article

Apabila field yang digunakan untuk content article bukan bernama `content`, anda dapat mengkonfigurasinya dengan menambahkan attribute `$paginatedContentAttribute` dengan value berupa nama dari field content article anda pada model yang menggunakan service Multi Page Articles
```
<?php

namespace App\Models;

use App\Services\Article\MultiPageArticles;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use MultiPageArticles;

    /** @var string **/
    protected $paginatedContentAttribute = 'article_content';
}
```
