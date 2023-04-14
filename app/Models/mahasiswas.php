<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswas extends Model
{
    use HasFactory;
    //use HasFactory; digunakan untuk meng-import trait HasFactory yang disediakan oleh Laravel. Trait ini akan membantu kita untuk membuat factory dan seeding pada model ini.
    protected $fillable = ['nim', 'nama', 'jurusan'];
    //protected $fillable = ['nim', 'nama', 'jurusan']; adalah properti yang mendefinisikan field-field pada tabel mahasiswas yang dapat diisi oleh user (fillable). Field-field tersebut adalah nim, nama, dan jurusan.
    public $timestamps = false;
    //public $timestamps = false; adalah properti yang mendefinisikan bahwa tabel mahasiswas tidak memiliki kolom created_at dan updated_at. Dengan mengatur properti ini menjadi false, 
}
