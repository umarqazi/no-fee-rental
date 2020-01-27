<?php

namespace App\Services;

/**
 * Class AWS3Service
 * @package App\Services
 */
class AWS3Service {

    /**
     * @var object
     */
    private $aws_s3;

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * AWS3Service constructor.
     */
    private function __construct() {
        $this->aws_s3 = \Storage::disk('s3');
    }

    /**
     * @return AWS3Service|null
     */
    public static function getInstance() {

        if (self::$instance === null) {
            return self::$instance = new AWS3Service;
        }

        return self::$instance;
    }

    /**
     * @param $path
     * @param $file
     * @param string $visibility
     * @return bool
     */
    public function upload($path, $file, string $visibility = 'public') {
        return $this->aws_s3->put($path, $file ,$visibility) ? true : false;
    }

    /**
     * @param $path
     * @return array|string
     */
    public function get($path) {
        $server_path = [];
        $url = env('AWS_URL');
        $data = $this->aws_s3->files($path);
        if (sizeof($data) < 1) {
            return 'No Files Exists';
        }
        foreach ($data as $files) {
            $server_path[] = $url.$files;
        }
        return $server_path;
    }

    /**
     * @param $path
     * @param $filename
     * @return bool
     */
    public function delete($path, $filename) {
        if ($this->aws_s3->delete($path.$filename)) {
            return true;
        }

        return false;
    }

    public function read() {
        return $this->aws_s3;
    }
}