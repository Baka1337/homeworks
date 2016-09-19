<?php
class Upload {
    private $name;
    private $tmpName;
    private $type;
    private $size;
    private $error;
    /**
     * UploadedFile constructor.
     * @param array $file
     */
    public function __construct(array $file){
        $this->name = $file['name'];
        $this->tmpName = $file['tmp_name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->error = $file['error'];
    }
    public function isUploaded(){
        return !$this->error;
    }
    public function isJpeg(){
        $type = explode('/', $this->type);
        return end($type) == 'jpeg';
    }
    public function isSizeLessThan($size){
        return $this->size < $size;
    }
    public function save($destination){
        $res = move_uploaded_file($this->tmpName, IMG_PATH . $destination);
        if (!$res) {
            throw new \Exception('file problem');
        }
    }
    public function isText()
    {

    }
    public function isPng()
    {

    }


}