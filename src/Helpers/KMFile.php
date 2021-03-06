<?php


namespace KMLaravel\ApiGenerator\Helpers;


use Illuminate\Support\Facades\File;

class KMFile
{

    /**
     * @param $fileName
     * @return string
     */
    public static function getFilesFromStubs($fileName)
    {
        return __DIR__ . "/../Stubs/$fileName.stub";
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getFilesFromStubsAsStream($fileName)
    {
        return File::get(__DIR__ . "/../Stubs/$fileName.stub");
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getRequestFile($fileName)
    {
        return app_path("Http/Requests/$fileName");
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getResourceFile($fileName)
    {
        return app_path("Http/Resources/".static::correctPath($fileName));
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getModelFile($fileName)
    {
        return app_path(static::correctPath($fileName));
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getRequestFileAsStream($fileName)
    {
        return File::get(app_path("Http/Requests/".static::correctPath($fileName)));
    }

    /**
     * @param $fileName
     * @return string
     */
    public static function getModelFileAsStream($fileName)
    {
        return File::get(app_path(static::correctPath($fileName)));
    }

    /**
     * @param $type
     * @param $className
     * @return string
     */
    public static function getClassNameSpace($type, $className)
    {
        if ($type == "model") {
            return "App\\$className";
        }
        return "App\\Http\\$type\\$className";
    }

    /**
     * @return string
     */
    public static function getCredentialJsonFilePath()
    {
        if (File::exists(resource_path("Views/ApisGenerator/credential.json"))) {
            return resource_path("Views/ApisGenerator/credential.json");
        }
    }

    /**
     * @return mixed
     */
    public static function getCredentialJsonFileAsJson()
    {
        if (File::exists(resource_path("Views/ApisGenerator/credential.json"))) {
            return json_decode(File::get(self::getCredentialJsonFilePath()));
        }
    }

    /**
     * @param $newData
     */
    public static function setDataToCredentialJsonFile($newData)
    {
        $data = self::getCredentialJsonFileAsJson();
        array_unshift($data, $newData);
        File::put(self::getCredentialJsonFilePath(), json_encode($data));
    }

    /**
     * @return bool
     */
    public static function baseControllerExists()
    {
        return File::exists(static::baseControllerPath());
    }

    /**
     * @return string
     */
    public static function baseControllerPath()
    {
        return app_path("Http/Controllers/BaseController.php");
    }

    /**
     * @param string $path
     * @return string
     */
    private static function correctPath($path){
        return str_replace('\\' , ' /' , $path);
    }
}
