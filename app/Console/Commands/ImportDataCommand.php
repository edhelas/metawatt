<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Data;
use App\Models\Scenario;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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

            $this->info('Importing ' . $scenarioPath);

            $content = file_get_contents($scenarioPath);
            $json = json_decode($content);

            $scenario = new Scenario;
            $scenario->name = $json->name;
            $scenario->slug = Str::slug($scenario->name, '-');
            $scenario->group = $json->group;
            $scenario->goals = serialize($json->goals ?? []);
            if (!empty($json->introduction)) $scenario->introduction = $json->introduction;
            if (!empty($json->description)) $scenario->description = preg_replace('/\\n/', "\n", $json->description);
            $scenario->save();

            foreach ($json->data->volume as $key => $values) {
                // Pass the comments
                if (substr($key, 0, 1) == '_') continue;

                if (!in_array($key, $categories->keys()->toArray())) {
                    $category = new Category;
                    $category->key = $key;
                    $category->name = $key;
                    $category->save();

                    $categories = Category::all()->keyBy('key');
                }

                $i = 0;

                foreach ($json->years as $year) {
                    $year = (int)$json->years[$i];

                    $production = $json->data->volume->{$key}[$i];

                    if ($production == null && $scenario->group == 'ademe') {
                        if (!isset($json->data->capacity->{$key}[$i])) {
                            $this->error('Error while importing capacity for ' . $key . ' element ' . $i);
                            exit;
                        }

                        $production = round(capacityToProduction($json->data->capacity->{$key}[$i]) * ademeLoadFactor($key), 2);
                    }

                    $data = new Data;
                    $data->scenario_id = $scenario->id;
                    $data->category_id = $categories[$key]->id;
                    $data->production = $production;
                    $data->capacity = $json->data->capacity->{$key}[$i];
                    $data->year = $year;
                    $data->save();

                    $i++;
                }
            }
        }
    }
}
