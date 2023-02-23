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
    protected $files = [
        "packages/Webkul/Admin/src/Resources/lang/en/app.php",
        "packages/Webkul/SocialLogin/src/Resources/lang/en/app.php",
        "packages/Webkul/BookingProduct/src/Resources/lang/en/app.php",
        "packages/Webkul/Core/src/Resources/lang/en/app.php",
        "packages/Webkul/Velocity/src/Resources/lang/en/app.php",
        "packages/Webkul/Tax/src/Resources/lang/en/app.php",
        "packages/Webkul/Customer/src/Resources/lang/en/app.php",
        "packages/Webkul/Paypal/src/Resources/lang/en/app.php",
        "packages/Webkul/Ui/src/Resources/lang/en/app.php",
        "packages/Webkul/Shop/src/Resources/lang/en/app.php",
    ];

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
    public function translateArrayRecursive(array $array, string $locale = 'en'): array
    {
        array_walk_recursive($array, function (&$value, $key) use ($locale) {
            if (is_string($value)) {
                $value = $this->translates->setSource('en')->setTarget($locale)->translate($value);
            }
        });
        return $array;
    }
    public function createFile($path, $content)
    {
        try {
            $newPath = str_replace('/en/', '/' . $this->locale . '/', $path);
            $content = "<?php\n\nreturn " . var_export($content, true) . ";\n";
            if (!file_exists(dirname($newPath))) {
                mkdir(dirname($newPath), 0777, true);
            }
            File::put($newPath, $content);
            return true;
        } catch (Exception $exception) {

            return $exception;
        }
    }
    public function processAll()
    {
        foreach ($this->files as $item) {
            try {
                if (file_exists(dirname(base_path($item)))) {
                    $file = base_path($item);
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
}
