<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Exception\MissingInputException;
use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\File;
use Exception;

class Translate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:translate
                            {--translateAll : process all document}
                            {--translateOnce : process once document}
                            {--locale= : locale}
                            {--path= : the path if process once}';

    protected $translates;
    protected $locale = 'en';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GoogleTranslate $translates)
    {
        parent::__construct();
        $this->translates = $translates;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locale = $this->option('locale');
        if (!$locale) {
            throw new MissingInputException('Not enough arguments when type is once (missing: "locale").');
        } else {
            $this->locale = $locale;
        }

        if ($this->option('translateOnce')) {
            $path = $this->option('path');
            if (!$path) {
                throw new MissingInputException('Not enough arguments when type is once (missing: "path").');
            }
            $this->processOnce($path);
        } else {
            $this->processAll();
        }
    }

    public function processAll()
    {
        $allAppLangFiles = $this->getAllAppLangFiles();
        foreach ($allAppLangFiles as $item) {
            try {

                if (file_exists($item)) {
                    $file = $item;
                    $arrays = include $file;
                    $arrayTranslated = $this->translateArrayRecursive($arrays, $this->locale);
                    $this->createFile($file, $arrayTranslated);
                }
            } catch (Exception $exception) {
                throw new MissingInputException($exception);
            }
        }
        throw new MissingInputException('Dịch thành công');
    }

    public function processOnce($path = '')
    {
        try {
            $path = base_path($path);
            if (file_exists($path)) {
                $arrays = include $path;
                $arrayTranslated = $this->translateArrayRecursive($arrays, $this->locale);
                $this->createFile($path, $arrayTranslated);
            } else {
                throw new MissingInputException('path does not exist (missing: "' . $path . '").');
            }
        } catch (Exception $exception) {
            throw new MissingInputException($exception);
        }
        throw new MissingInputException('Dịch thành công');
    }

    public function getAllAppLangFiles($folder = 'packages', $language = 'en')
    {
        $appFiles = [];
        $targetFilePath = str_replace('en',$language , 'src\Resources\lang\en\app.php');
        $directory = base_path($folder);
        $allFiles = File::allFiles($directory);
        foreach ($allFiles as $file) {
            $filePath = $file->getPathname();
            if (strpos($filePath, $targetFilePath) != false) {
                $appFiles[] = $filePath;
            }
        }

        return $appFiles;
    }

    public function translateArrayRecursive(array $array, string $locale = 'en'): array
    {
        array_walk_recursive($array, function (&$value, $key) use ($locale) {
            if (is_string($value)) {
                $valueBefore = $value;

                // Capitalize first letter if original is capitalized
                if (ctype_upper(substr($valueBefore, 0, 1))) {
                    $value = ucfirst($this->translates->setSource('en')->setTarget($locale)->translate($value));
                } else {
                    $value = $this->translates->setSource('en')->setTarget($locale)->translate($value);
                }

                dump("Key: $key, Before: $valueBefore, After: $value");
            }
        });
        return $array;
    }

    public function createFile($path, $content)
    {
        try {
            $newPath = str_replace('en', $this->locale , $path);
            $content = "<?php\n\nreturn " . var_export($content, true) . ";\n";
            if (!file_exists(dirname($newPath))) {
                // Thư mục không tồn tại, tạo mới
                mkdir(dirname($newPath), 0777, true);
            } else {
                // Thư mục đã tồn tại, xóa và tạo lại
                rmdir(dirname($newPath));
                mkdir(dirname($newPath), 0777, true);
            }

            File::put($newPath, $content);
            return true;
        } catch (Exception $exception) {

            return $exception;
        }
    }

}