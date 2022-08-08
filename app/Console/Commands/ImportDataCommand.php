<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Data;
use App\Models\Scenario;
use Illuminate\Console\Command;

class ImportDataCommand extends Command
{
    protected $signature = 'metawatt:import-data';

    protected $description = 'Import the scenarios data';

    public function handle()
    {
        // Clear all scenarios
        Scenario::truncate();
        Category::truncate();

        foreach (glob('data/*.json') as $scenarioPath) {
            // Get the categories
            $categories = Category::all()->keyBy('key');

            $this->info('Importing '.$scenarioPath);

            $json = json_decode(file_get_contents($scenarioPath));

            $scenario = new Scenario;
            $scenario->name = $json->name;
            $scenario->group = $json->group;
            $scenario->save();

            foreach ($json->data->volume as $key => $years) {
                if (!in_array($key, $categories->keys()->toArray())) {
                    $category = new Category;
                    $category->key = $key;
                    $category->name = $key;
                    $category->save();

                    $categories = Category::all()->keyBy('key');
                }

                $i = 0;

                foreach ($years as $year) {
                    $data = new Data;
                    $data->scenario_id = $scenario->id;
                    $data->category_id = $categories[$key]->id;
                    $data->production = $year;
                    $data->capacity = $json->data->capacity->{$key}[$i];
                    $data->year = $json->years[$i];
                    $data->save();

                    $i++;
                }
            }
        }
    }
}
