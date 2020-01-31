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

    private $aws_url;

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * AWS3Service constructor.
     */
    private function __construct() {
        $this->aws_s3 = \Storage::disk('s3');
        $this->aws_url = config('filesystems.disks.s3.url');
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
        return $this->aws_s3->put($path, $file ,$visibility);
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
     * @param $filename
     * @return bool
     */
    public function delete($filename) {
        if ($this->aws_s3->delete($filename)) {
            return true;
        }

        return false;
    }

    /**
     * @param $image_name
     * @return string
     */
    public function read($image_name) {
        return sprintf('%s%s', $this->aws_url, $image_name);
    }
}