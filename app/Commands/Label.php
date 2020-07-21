<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Label extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'label
        {path : Enter the folder path in " "}
        {--p|label-position= : Enter the label position, default: A1}
        {--i|label-path= : Enter the label image path in " ", default: images/label-internal-use-only.jpg}
        {--s|label-height= : Enter the height size of label, default: 50}
        {--o|override= : Overding the existing files y/n, default: n}
    ';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Please input the information for labeling Excel file. More detail type label -h';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $initValue = [
            'labelPosition' => $this->option('label-position') ? $this->option('label-position') : 'A1',
            'labelPath' => $this->option('label-path') ? $this->option('label-path') : base_path().'/images/label-internal-use-only.jpg',
            'labelHeight' => $this->option('label-height') ? $this->option('label-height') : 50,
            'override' => $this->option('override') ? $this->option('override') : 'n',
        ];

        $this->info('_____________________________________________________________________________');
        $this->info('YOUR CONFIGURATIONS:');
        $this->info('  * Your folder directory is ---> ' . $this->argument('path'));
        $this->info('  * Your label\'s position is ---> ' . $initValue['labelPosition']);
        $this->info('  * Your label\'s image path is ---> ' . $initValue['labelPath']);
        $this->info('  * Your label\'s height is ---> ' . $initValue['labelHeight']);

        $repath = $this->rePath($this->argument('path'));
        if ($initValue['override'] == 'y') {
            $this->info('  * You chose to override the existing files');
        } else {
            mkdir($repath.'\\\\output', 0777, true);
            $this->info('  * Your output files will be in ---> ' . $this->argument('path') . '\\output');
        }
        $this->info('_____________________________________________________________________________');
        $files = scandir($repath);
        $arrExcelFiles = $this->getArrayExcelFiles($repath, $files);
        $this->info('PROCESSING YOUR FILES:');
        $this->info(json_decode('"\u21DB"').'  START  '.json_decode('"\u21DA"'));
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        foreach($arrExcelFiles as $i => $singleFile) {
            $spreadsheet = $reader->load($singleFile);
            $newSpreadsheet = $this->editSingleSheet($spreadsheet, $initValue, $repath, $singleFile);
            
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($newSpreadsheet);
            // $writer->setPreCalculateFormulas(false);

            if ($initValue['override'] == 'y') {
                $writer->save($repath."\\".pathinfo($singleFile)['basename']);
            } else {
                $writer->save($repath.'\\output\\'.pathinfo($singleFile)['basename']);
            }
        }
        echo PHP_EOL;
        $this->info(json_decode('"\u21DB"').'  FINISH  '.json_decode('"\u21DA"'));
        $this->info('_____________________________________________________________________________');
    }

    /**
     * Edit Single Sheet.
     *
     * @return spreadsheet
     */
    private function editSingleSheet($spreadsheet, $initValue, $repath, $singleFile) {
        $sheetNumber = $spreadsheet->getSheetCount();
        for($i = 0; $i < $sheetNumber; $i++) {
            print(json_decode('"\u25AA"'));
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('LableSheet'.$i);
            $drawing->setDescription('Lable of Sheet '.$i);
            $drawing->setPath($this->rePath($initValue['labelPath']));
            $drawing->setCoordinates($initValue['labelPosition']);
            $drawing->setHeight($initValue['labelHeight']);
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(45);
            
            $drawing->setWorksheet($spreadsheet->getSheet($i));
        }

        return $spreadsheet;
    }

    /**
     * Re-path for Widnows
     *
     * @return path
     */
    private function rePath ($path) {
        return str_replace('\\', '\\\\', $path);
    }

    /**
     * Get only Excel Files in foleder
     *
     * @return arrExcelFilesName
     */
    private function getArrayExcelFiles($dirPath, $allFiles) {
        $arrExcelFilesName = [];
        foreach($allFiles as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) == 'xlsx'){
                $arrExcelFilesName[] = $dirPath.'\\\\'.$file;
            }
        }
        return $arrExcelFilesName;
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
