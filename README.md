| Nama | NRP |
|---------------------------|------------|
|Syarifah Talitha Erfany | 5025211175 |

## Daftar Isi
- [Tugas 1](#tugas-1)
- [Tugas 2](#tugas-2)

## Tugas 1
### Home Page 
- **Laptop :**

![image](images/homepage.jpg)

- **Mobile :**

![image](images/homepagemobile.jpg)


**Penjelasan :**
    ```
    <x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <h3 class="text-l"> Ini adalah Home Page </h3>
    </x-layout>
    ```

Menggunakan navbar dan layout yang telah diabstraksi menjadi component yang dipanggil dalam home page. Menggunakan title yang telah diberikan dalam routing.

**Nav-link :**
    ```
    <a {{  $attributes }}
    class="{{ $active ? 'bg-gray-900 text-white' : "text-gray-300 hover:bg-gray-700 hover:text-white"}} rounded-md px-3 py-2 text-sm font-medium" 
    aria-current="{{ request()->is('/') ? 'page' : false }}">{{ $slot }}</a>
    ```
Komponen yang dapat dipanggil dalam kelas navbar agar tidak looping, sehingga dapat menggunakan best practice.

**Route :**
    ```
    Route::get('/', function () {
        return view('home', ['title' => 'Home Page']);
    });
    ```
Akan mengembalikan view ke `home`, dengan title yang di set adalah `Home Page`.

### Blog Page 
- **Laptop :**

![image](images/blogpage.jpg)

- **Mobile :**

![image](images/blogpagemobile.jpg)

**Penjelasan :**
    ```
    <x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <h3 class="text-l"> Ini adalah Blog Page </h3>
    </x-layout>
    ```

Menggunakan navbar dan layout yang telah diabstraksi menjadi component yang dipanggil dalam blog page. Menggunakan title yang telah diberikan dalam routing.

**Route :**
    ```
    Route::get('/blog', function () {
        return view('blog', ['title' => 'Blog Page']);
    });
    ```
Akan mengembalikan view ke `blog`, dengan title yang di set adalah `Blog Page`.

### About Page 
- **Laptop :**

![image](images/aboutpage.jpg)

- **Mobile :**

![image](images/aboutpagemobile.jpg)

**Penjelasan :**
    ```
    <x-layout>
        <x-slot:title> 
        {{ $title }}
        </x-slot:title>
        <h3 class="text-l"> Ini adalah About Page </h3>
        <p> Nama: {{ $nama }} </p>
    </x-layout>
    ```

Menggunakan navbar dan layout yang telah diabstraksi menjadi component yang dipanggil dalam about page. Menggunakan title yang telah diberikan dalam routing.

**Route :**
    ```
    Route::get('/about', function () {
        return view('about', ['title' => 'About Page', 'nama' => 'Lita']);
    });
    ```
Akan mengembalikan view ke `about`, dengan title yang di set adalah `About Page`, memiliki atribut dari `nama = Lita`.

### Contact Page 
- **Laptop :**

![image](images/contactpage.jpg)

- **Mobile :**

![image](images/contactpagemobile.jpg)

**Penjelasan :**
    ```
    <x-layout>
        <x-slot:title>
        {{ $title }}
        </x-slot:title>
        <h3 class="text-l"> Ini adalah Contact Page </h3>
    </x-layout>
    ```

Menggunakan navbar dan layout yang telah diabstraksi menjadi component yang dipanggil dalam contact page. Menggunakan title yang telah diberikan dalam routing.

**Route :**
    ```
    Route::get('/contact', function () {
        return view('contact', ['title' => 'Contact Page']);
    });
    ```
Akan mengembalikan view ke `contact`, dengan title yang di set adalah `Contact Page`.

## Tugas 2 - **View Data & Model**
### Perbaikan Atribut di Navbar

Atribut tambahan seperti `aktif="aktif"` yang muncul di elemen HTML perlu dihapus

**Penjelasan :**
    ```
    @props(['aktif' => false])
    ```

1. Gunakan properti props di Blade untuk menyimpan atribut komponen.
2. Atribut `aktif` sekarang hanya digunakan di dalam komponen, bukan di elemen HTML.

### Mengirimkan Data ke View

**Penjelasan :**
    ```
    Route::get('/post', function () {
        return view('post', [
            'title' => 'Halaman Post',
            'posts' => [
                [
                    'title' => 'Judul Artikel 1',
                    'author' => 'Sandika Gali',
                    'body' => 'Lorem ipsum dolor sit amet.',
                    'slug' => 'judul-artikel-1'
                ],
                [
                    'title' => 'Judul Artikel 2',
                    'author' => 'Sandika Gali',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'slug' => 'judul-artikel-2'
                ]
            ]
        ]);
    });
    ```

1. Data dikirim dalam bentuk associative array dan langsung diekstrak sebagai variabel di view.

### Membuat Halaman Blog

- **HTML Markup:**
Menggunakan elemen `<article>` untuk menampilkan setiap postingan.
Tambahkan elemen judul `(<h2>)`, penulis, tanggal, dan paragraf isi artikel. Lalu berikan tombol Read More untuk setiap artikel.

- **CSS Tailwind:**
Untuk styling gunakan `py-8`, `max-w-screen-md`, dan `border-gray-300`.

**Penjelasan :**
```
@foreach ($posts as $post)
<article>
    <h2>{{ $post['title'] }}</h2>
    <p>{{ $post['author'] }}</p>
    <p>{{ Str::limit($post['body'], 100) }}</p>
    <a href="/post/{{ $post['slug'] }}">Read More</a>
</article>
@endforeach

```

1. Gunakan `@foreach` di Blade untuk menampilkan daftar artikel


### Menampilkan Detail Artikel

Atribut tambahan seperti `aktif="aktif"` yang muncul di elemen HTML perlu dihapus

**Penjelasan :**
    ```
    Route::get('/post/{slug}', function ($slug) {
        $posts = [
            [
                'title' => 'Judul Artikel 1',
                'author' => 'Sandika Gali',
                'body' => 'Isi lengkap artikel pertama, 
                'slug' => 'judul-artikel-1' 
            ], 
            [   'title' => 'Judul Artikel 2', 
                'author' => 'Sandika Gali', 
                'body' => 'Isi lengkap artikel kedua.', 
                'slug' => 'judul-artikel-2' 
            ] 
        ];

    $post = collect($posts)->firstWhere('slug', $slug);

    if (!$post) {
        abort(404); 
    }

    return view('post', [
        'title' => $post['title'],
        'post' => $post
    ]);
    });
    ```

### Slug Sebagai Identifikasi

Untuk menghindari URL yang mudah ditebak menggunakan ID numerik, gunakan `slug`.

**Slug :** string unik yang biasanya berbasis judul artikel.

Contoh slug:
> Judul Artikel 1 -> judul-artikel-1

> Judul Artikel 2 -> judul-artikel-2
Tambahkan properti slug ke setiap artikel di array data.

**Penjelasan :**
    ```
    /post/judul-artikel-1
    ```

1. Dengan slug, URL menjadi lebih deskriptif dan SEO-friendly

### Fungsi Bantu Laravel

- **Str::limit:** : Membatasi jumlah karakter teks

**Penjelasan :**
    ```
    Str::limit($post['body'], 100);
    ```

1. Teks hanya ditampilkan 100 karakter pertama, diakhiri dengan `...`

- **Collect:** : Mempermudah manipulasi data array.

**Penjelasan :**
    ```
    collect($posts)->firstWhere('slug', $slug);
    ```

### Pentingnya Model
- **Masalah dengan Data Manual**
  - Sebelumnya, data didefinisikan langsung di dalam routes, baik untuk halaman daftar postingan maupun detail postingan.
  - Masalah:
    1. Duplikasi data pada rute-rute berbeda.
    2. Perubahan atau penambahan data membutuhkan banyak langkah.

- **Solusi dengan Model**
  - Model mengelola data secara terpusat.
  - Data diambil dari model, bukan langsung didefinisikan di rute.

### Konsep MVC
**MVC (Model-View-Controller) :** Pola arsitektur yang digunakan Laravel untuk memisahkan tanggung jawab aplikasi:

- **Model :** Mengelola data dan logika bisnis (misalnya: mengambil data dari database atau API).
- **View :** Menampilkan data kepada pengguna.
- **Controller :** Menjembatani model dan view, menangani request, dan menjalankan logika aplikasi.

**Proses Alur MVC :**

1. `User` melakukan request ke aplikasi.
2. `Router` mengarahkan request ke `Controller`.
3. `Controller` menggunakan `Model` untuk mengambil atau memproses `data`.
4. `Data` dikirim ke `View` untuk ditampilkan kepada `user`.

### Membuat Model Manual

**Langkah Membuat Model**
1. Buat file model di folder `app/Models`.

2. Contoh model sederhana `Post`:
    ```
    namespace App\Models;

    class Post {
        public static function all() {
            return [
                [
                    'title' => 'Judul Artikel 1',
                    'author' => 'Sandika Gali',
                    'body' => 'Lorem ipsum dolor sit amet.',
                    'slug' => 'judul-artikel-1'
                ],
                [
                    'title' => 'Judul Artikel 2',
                    'author' => 'Sandika Gali',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'slug' => 'judul-artikel-2'
                ]
            ];
        }

        public static function find($slug) {
            return collect(self::all())->firstWhere('slug', $slug);
        }
    }

    ```

3. Pindahkan data dari rute ke model.

**Menggunakan Model di Rute**

1. Impor model dengan namespace
    ```
    use App\Models\Post;
    ```

2. Rute untuk daftar postingan
    ```
    Route::get('/post', function () {
        return view('post', [
            'title' => 'Halaman Post',
            'posts' => Post::all()
        ]);
    });
    ```

3. Rute untuk detail postingan
    ```
    Route::get('/post/{slug}', function ($slug) {
        $post = Post::find($slug);

        if (!$post) {
            abort(404);
        }

        return view('post', [
            'title' => $post['title'],
            'post' => $post
        ]);
    });
    ```

### Fitur Autoloading dan Namespace

**Autoloading**
- Laravel menggunakan autoloading standar `PSR-4`.

- Class dalam folder `app` otomatis terdeteksi oleh Laravel, tetapi harus memiliki namespace yang sesuai.

**Namespace**
Namespace digunakan untuk menghindari konflik nama class.

1. Contoh namespace untuk model `Post`
    ```
    namespace App\Models;
    ```

2. Impor model ke rute
    ```
    use App\Models\Post;
    ```

### Peningkatan Model

**Membuat Fungsi find untuk Pencarian Data**

- Logika pencarian data dipindahkan dari rute ke model

    ```
    public static function find($slug) {
        return collect(self::all())->firstWhere('slug', $slug);
    }
    ```

**Mengatasi Error 404** 

1. Tambahkan validasi untuk menangani data yang tidak ditemukan

    ```
    if (!$post) {
        abort(404);
    }
    ```

### Keuntungan Menggunakan Model

**Membuat Fungsi find untuk Pencarian Data**

1. `Pengelolaan Data Terpusat :` Data hanya didefinisikan sekali di model.

2. `Mudah Dikembangkan :` Model dapat diperluas untuk integrasi dengan database, API, atau fitur lainnya.

3. `Logika Terpisah :` Controller hanya menangani logika permintaan, sedangkan logika data dikelola oleh model.

## Tugas 3 - **Database & Migration + Eloquent ORM & Post Model**

### Database

**Konfigurasi Database**
- Laravel mendukung berbagai jenis database, seperti `SQLite`, `MySQL`, dan `PostgreSQL`.
- File konfigurasi database terdapat di `.env`. Contoh pengaturan:

    ```
    DB_CONNECTION=sqlite
    DB_DATABASE=/path/to/database.sqlite
    ```

- Menggunakan SQLite
    
    SQLite : database berbasis file yang sederhana dan tidak memerlukan server database. File SQLite default Laravel berada di folder database dengan `nama database.sqlite.`

- Menggunakan MySQL

    Ubah koneksi di `.env` menjadi `DB_CONNECTION=mysql.`

    Atur parameter MySQL seperti `DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, dan DB_PASSWORD.`

    Jalankan server MySQL, misalnya menggunakan Laragon.

### Migration
- Method `up` : logika untuk membuat skema tabel
- Method `down` : Logika untuk menghapus atau membatalkan skema tabel

**Membuat Migrasi Baru**
1. Membuat tabel `post`
    ```
    php artisan make:migration create_posts_table
    ```

2. Edit file yang dihasilkan di folder `/database/migrations`
    ```
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('slug')->unique();
            $table->text('body');
            $table->timestamps();
        });
    }
    ```

**Menjalankan Migrasi**
- Menjalankan menggunakan,
    ```
    php artisan migrate
    ```

- Untuk mereset database dan menjalankan ulang migration,
    ```
    php artisan migrate:fresh
    ```

**Mengisi Data ke Database**
1. Buka `TablePlus.`
2. Navigasi ke tabel yang diinginkan dan masukkan data secara manual,
    - Tambahkan baris menggunakan antarmuka GUI.
    - Simpan perubahan dengan menekan `Ctrl + S`.

    Contoh entri data untuk tabel `posts`:

    | ID  | Judul           | Penulis  | Slug           | Isi               |
    |-----|-----------------|----------|----------------|-------------------|
    | 1   | Tulisan Satu    | Sandika  | tulisan-satu   | Konten Tulisan 1  |
    | 2   | Tulisan Dua     | Sandika  | tulisan-dua    | Konten Tulisan 2  |
    | 3   | Artikel Laravel | Sandika  | artikel-laravel| Konten Artikel 1  |

### Eloquent ORM
**Pendahuluan**

`Eloquent ORM` memetakan tabel di database menjadi objek model di aplikasi Laravel. Dengan menggunakan Eloquent, kita bisa:

- Membaca (retrieve), menulis (insert), mengubah (update), dan menghapus (delete) data dengan lebih sederhana.
- Menggunakan model untuk memanipulasi tabel tanpa harus menulis query SQL manual.

**Membuat Model Post**
1. Menghubungkan Model dengan Tabel
    ```
    php artisan make:model Post
    ```
2. Penyesuaian Nama Tabel dan Primary Key
    ```
    // Mengatur nama tabel
    protected $table = 'blog_posts';

    // Mengatur primary key
    protected $primaryKey = 'post_id';
    ```

**Menampilkan Data dari Database**
1. Pastikan model sudah terhubung ke tabel
2. Gunakan method bawaan seperti `all()` untuk mengambil semua data
    ```
    $posts = Post::all();
    ```
3. Data otomatis terhubung ke tampilan
    ```
    @foreach ($posts as $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    @endforeach
    ```

**Mengelola Data Menggunakan Eloquent**
- Mass Assignment dan Properti Fillable

Untuk menghindari error Mass Assignment Exception saat menambahkan data, tambahkan properti `$fillable` di model
    ```
    protected $fillable = ['title', 'author', 'slug', 'body'];
    ```

- Menambahkan Data dengan Tinker
    1. Buka terminal dan jalankan
        ```
        php artisan tinker
        ```
    2. Tambahkan data menggunakan metode `create`
        ```
        App\Models\Post::create([
        'title' => 'Judul Artikel',
        'author' => 'Penulis',
        'slug' => 'judul-artikel',
        'body' => 'Isi artikel di sini.'
        ]);
        ```
- Manipulasi Data (CRUD)
    - Membaca data
        ```
        Post::all();           // Semua data
        Post::find(1);         // Data dengan ID 1
        Post::where('slug', 'judul-artikel')->first(); // Data dengan slug tertentu
        ```
    - Mengupdate data
        ```
        $post = Post::find(1);
        $post->title = 'Judul Baru';
        $post->save();
        ```
    - Menghapus data
        ```
        $post = Post::find(1);
        $post->delete();
        ```

**Menggunakan Route Model Binding**

`Route Model Binding :` menghubungkan model secara langsung dengan rute berdasarkan parameter.
```
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['post' => $post]);
});
```

_Penjelasan :_
- `{post:slug}:` Laravel akan mencari data berdasarkan kolom `slug` (bukan default `id`).
- `$post:` Instance model `Post` otomatis disediakan di parameter rute.

**Membuat Model dan Migration Secara Otomatis**

Gunakan perintah berikut untuk membuat model beserta file migration,
```
php artisan make:model Post -m
```

_Penjelasan :_
- Opsi `-m` otomatis membuat migration dengan nama sesuai model `(create_posts_table)`.


## Tugas 4 - **Model Factories + Eloquent Relationship + Post Category + Database Seeder**

### Model Factories

- `Model Factory :` Sebuah "pabrik data" yang mendefinisikan aturan untuk mengisi kolom-kolom pada tabel database secara otomatis.

- Laravel menggunakan library `Faker` untuk menghasilkan data palsu yang terlihat nyata, seperti nama, email, alamat, dan lainnya.

- Model Factories digunakan bersamaan dengan `Eloquent ORM`.

**Membuat Factory Baru**
```
php artisan make:factory PostFactory
```

_Penjelasan :_
- `PostFactory` adalah nama factory, sesuai dengan model Post.
- Factory ini akan dibuat di folder `database/factories`.

**Mendefinisikan Aturan Factory**

Setelah factory dibuat, tambahkan aturan untuk mengisi kolom pada tabel di method `definition()`.
```
public function definition()
{
    return [
        'title' => $this->faker->sentence(),
        'author' => $this->faker->name(),
        'slug' => \Illuminate\Support\Str::slug($this->faker->sentence()),
        'body' => $this->faker->text(200),
    ];
}
```

_Penjelasan :_
- `sentence() :` Menghasilkan sebuah kalimat.
- `name() :` Menghasilkan nama.
- `text(200) :` Menghasilkan teks sepanjang 200 karakter.
- `Str::slug() :` Mengubah string menjadi slug format.

**Menggunakan Factory untuk Membuat Data**
1. Masuk ke `Tinker`
    ```
    php artisan tinker
    ```
2. Membuat 1 data
    ```
    App\Models\Post::factory()->create();
    ```
3. Mmebuat banyak data
    ```
    App\Models\Post::factory()->count(10)->create();
    ```

**State Management dalam Factory**

Untuk memodifikasi state tertentu, tambahkan method `kustom` pada factory.
```
public function unverified()
{
    return $this->state(fn (array $attributes) => [
        'email_verified_at' => null,
    ]);
}
```

Gunakan method ini untuk data dengan state tertentu
```
App\Models\User::factory()->unverified()->create();
```

**Mengubah Lokal Fakta Data**

Secara default, Faker menghasilkan data dengan locale `en_US`. Untuk mengubahnya, ubah konfigurasi di file `.env`
```
FAKER_LOCALE=id_ID
```

_Penjelasan :_
- Contoh data dengan `id_ID` akan menghasilkan nama seperti "Iriana Mariati" atau "Saadat Tampubolon."

**Studi Kasus: Membuat Data Dummy untuk Blog**
1. Buat factory untuk model `Post`
    ```
    php artisan make:factory PostFactory
    ```

2. Definisikan aturan di file `factory`
    ```
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'slug' => \Illuminate\Support\Str::slug($this->faker->sentence()),
            'body' => $this->faker->text(200),
        ];
    }
    ```

3. Buat 200 data untuk tabel posts
    ```
    App\Models\Post::factory()->count(200)->create();
    ```'

### Eloquent Relationship

**Jenis Relasi dalam Eloquent**
- `One To One :` Satu data di tabel A berhubungan dengan satu data di tabel B.
- `One To Many :` Satu data di tabel A berhubungan dengan banyak data di tabel B.
- `Many To Many :` Banyak data di tabel A berhubungan dengan banyak data di tabel B.

Untuk tutorial ini, fokus pada `One To Many`:
- Satu User memiliki banyak Post `(Has Many)`.
- Satu Post dimiliki oleh satu User `(Belongs To)`.

**Menambahkan Foreign Key di Migration**
1. Buka file migration tabel posts dan tambahkan kolom berikut,
    ```
    $table->foreignId('author_id')->constrained('users');
    ```
    _Penjelasan :_
    - `foreignId :` Menambahkan kolom Foreign Key.
    - `constrained('users') :` Menghubungkan kolom `author_id` ke kolom `id` di tabel `users`.
2. Jalankan migrasi
    ```
    php artisan migrate:fresh
    ```
    _Penjelasan :_
    - Kolom `author_id` di tabel `posts` menjadi Foreign Key yang terhubung ke tabel users.

**Mendefinisikan Relasi pada Model**
- Pada Model `Post`
    ```
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    ```
- Pada Model `User`
    ```
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    ```

**Contoh Implementasi Relasi User dan Post**
- Membuat Data Dummy dengan Relasi
    1. Tambahkan aturan di `PostFactory` untuk menghubungkan `author_id` dengan `UserFactory`
        ```
        'author_id' => User::factory(),
        ```
    2. Buat data dummy
        ```
        php artisan tinker
        App\Models\Post::factory()->count(10)->create();
        ```
        
        _Penjelasan :_
        - Laravel akan otomatis membuat data user baru untuk setiap `author_id`.

- Menggunakan Recycle untuk Membatasi User
    ```
    App\Models\Post::factory()->count(100)
    ->for(App\Models\User::factory()->count(5)->create())
    ->create();
    ```

**Menggunakan Relasi dalam Query**
- Mengambil Relasi dari Model `Post`
    ```
    $post = Post::first();
    $author = $post->author; // Mengambil data user yang menulis post
    echo $author->name;
    ```
- Mengambil Relasi dari Model `User`
    ```
    $user = User::first();
    $posts = $user->posts; // Mengambil semua post yang ditulis user
    foreach ($posts as $post) {
        echo $post->title;
    }
    ```

### Post Category

**Pendahuluan**
Fitur kategori memungkinkan setiap postingan memiliki kategori spesifik. Kategori ini dihubungkan ke postingan menggunakan relasi `One-to-Many :`

- Satu Kategori memiliki banyak postingan `(Has Many)`.
- Satu Postingan hanya memiliki satu kategori `(Belongs To)`.

**Langkah-Langkah Utama**
1. Membuat model, migration, dan factory untuk kategori.
2. Menambahkan Foreign Key `category_id` di tabel `posts`.
3. Mendefinisikan relasi pada model `Post` dan `Category`.
4. Mengisi data dummy untuk kategori dan postingan menggunakan factory.
5. Menampilkan kategori di tampilan.
6. Menambahkan rute untuk kategori.

**Membuat Model, Migration, dan Factory Kategori**

Gunakan perintah berikut untuk membuat model, migration, dan factory sekaligus:
```
php artisan make:model Category -mf
```

Update Migration categories:
```
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->timestamps();
});
```

**Menambahkan Foreign Key di Tabel Post**

Tambahkan kolom category_id di migration tabel posts:
```
$table->foreignId('category_id')->constrained('categories');
```

Setelah selesai, jalankan migrasi:
```
php artisan migrate:fresh
```

**Menambahkan Foreign Key di Tabel Post**

Mendefinisikan Relasi pada Model

- Pada Model `Category`
    ```
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
    ```

- Pada Model `Post`
    ```
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    ```

**Mengisi Data Dummy Menggunakan Factory**

- Update `CategoryFactory` untuk membuat kategori secara otomatis
    ```
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'slug' => \Illuminate\Support\Str::slug($this->faker->word()),
        ];
    }
    ```

- Tambahkan kategori pada `PostFactory`
    ```
    'category_id' => Category::factory(),
    ```

- Gunakan perintah berikut untuk mengisi data dummy
    ```
    php artisan tinker
    ```
    ```
    App\Models\Post::factory()
        ->count(100)
        ->recycle([
            App\Models\Category::factory()->count(3)->create(),
            App\Models\User::factory()->count(5)->create()
        ])
        ->create();
    ```

**Menampilkan Kategori di Tampilan**

- Pada tampilan `post.blade.php`, tambahkan kategori:
    ```
    <div>
        Kategori: <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
    </div>
    ```

**Menambahkan Rute untuk Kategori**
    ```
    Route::get('/categories/{category:slug}', function (Category $category) {
        return view('posts', [
            'title' => "Articles in Category: {$category->name}",
            'posts' => $category->posts,
        ]);
    });
    ```

### Database Seeder

`Database seeder :` fitur Laravel yang mempermudah pengisian data awal atau data dummy ke dalam database. Seeder bekerja dengan menggabungkan kemampuan Factory dan Query Builder untuk menghasilkan data secara otomatis dan terstruktur.

**Pendahuluan**

Seeder berfungsi untuk:

- Mengisi data awal atau dummy pada database.
- Melakukan testing UI dengan data realistik.
- Membuat proses pengisian data lebih otomatis dibandingkan menggunakan Tinker atau query manual.

**Keunggulan Database Seeder**
- `Integrasi dengan Factory :` Seeder dapat menggunakan Factory untuk menghasilkan data dummy secara otomatis.
- `Efisiensi Waktu :` Tidak perlu menginput data secara manual setelah melakukan migrasi.
- `Kemudahan Testing :` Membantu pengujian aplikasi dengan dataset besar atau kompleks.

**Langkah-Langkah Penggunaan**
1. Membuat Database Seeder
    ```
    php artisan make:seeder NamaSeeder
    ```

2. Menulis Logika Seeder
    ```
    public function run()
    {
        User::factory()->count(10)->create();
    }
    ```

3. Memanggil Seeder di DatabaseSeeder
    ```
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);
    }
    ```

5. Menjalankan Seeder
    ```
    php artisan db:seed
    ```

**Membuat Database Seeder**
1. Default Seeder
- File `DatabaseSeeder` sudah tersedia secara default di folder `database/seeders`.
2. Membuat Seeder Baru
    ```
    php artisan make:seeder NamaSeeder
    ```
3. Menulis Data di Seeder
    ```
    public function run()
    {
        User::create([
            'name' => 'Sandika',
            'username' => 'sandikagalih',
            'email' => 'sandikagalih@example.com',
            'password' => Hash::make('password'),
        ]);
    }
    ```

**Menjalankan Seeder**
- Menjalankan Semua Seeder
    ```
    php artisan db:seed
    ```

- Menjalankan Seeder Spesifik
    ```
    php artisan db:seed --class=NamaSeeder
    ```

- Migrasi dan Seeding Sekaligus
    ```
    php artisan migrate:fresh --seed
    ```
    
**Menggabungkan Seeder dan Factory**
```
public function run()
{
    Post::factory()->count(100)->create([
        'author_id' => User::factory()->count(5)->create(),
        'category_id' => Category::factory()->count(3)->create(),
    ]);
}
```

**Optimasi Seeder**
1. Membersihkan Cache Autoload
    ```
    composer dump-autoload
    php artisan optimize:clear
    ```
2. Menggunakan Data Tetap
3. Menggabungkan Seeder dan Factory