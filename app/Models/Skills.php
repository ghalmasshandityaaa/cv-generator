<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Skills extends Model
{
    protected $table = 'keterampilans';
    protected $primaryKey = 'id';

    public function getAllData()
    {
        return DB::table($this->table)->where($this->primaryKey, Auth::user()->id)->get();
    }

    public function getDataById($id)
    {
        $data = DB::table($this->table)->where($this->primaryKey, $id)->first();
        return $data;
    }

    public function updateData($data, $id)
    {
        $result = DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->update($data);
        return $result;
    }

    public function deleteData($id)
    {
        $result = DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->delete();
        return $result;
    }
}
