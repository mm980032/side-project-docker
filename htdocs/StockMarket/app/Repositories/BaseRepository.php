<?php
namespace App\Repositories;

use App\Trait\HasCRUD;
use PDO;

abstract class BaseRepository {

    use HasCRUD;

    protected $model;
    protected $unique;

    abstract public function model();
    abstract public function uniqueID();


    public function __construct()
    {
        $this->model = app($this->model());
        $this->unique = $this->uniqueID();
    }

    /**
     * 唯一值是否存在
     *
     * @param string $unique
     * @return boolean
     * @author ZhiYong
     */
    public function isExistUnique(string $unique) : bool
    {
        return $this->model->where($this->unique, $unique)->exists();
    }

    /**
     * 建立唯一值
     *
     * @return string
     * @author ZhiYong
     */
    public function createUniqueID() : string
    {
        while (true) {
            $id = md5(uniqid(). sha1(time()) . rand(0, 999999999));
            if(!$this->isExistUnique($id)){
                break;
            }
        }
        return $id;
    }
}
