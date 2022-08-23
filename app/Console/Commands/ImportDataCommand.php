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

            $this->info('Importing ' . $scenarioPath);

            $json = json_decode(file_get_contents($scenarioPath));

            $scenario = new Scenario;
            $scenario->name = $json->name;
            $scenario->group = $json->group;
            if (!empty($json->introduction)) $scenario->introduction = $json->introduction;
            if (!empty($json->description)) $scenario->description = $json->description;
            $scenario->save();

            foreach ($json->data->volume as $key => $values) {
                if (!in_array($key, $categories->keys()->toArray())) {
                    $category = new Category;
                    $category->key = $key;
                    $category->name = $key;
                    $category->save();

                    $categories = Category::all()->keyBy('key');
                }

                $i = 0;

                foreach ($json->years as $year) {
                    // We have a missing year to fill
                    $missingYear = (substr($json->years[$i], 0, 1) == '*');
                    $year = $missingYear
                        ? (int)substr($json->years[$i], 1)
                        : (int)$json->years[$i];

                    $resolvedProduction = $missingYear
                        ? ($json->data->volume->{$key}[$i - 1] + $json->data->volume->{$key}[$i + 1]) / 2
                        : $json->data->volume->{$key}[$i];

                    if ($scenario->group == 'ademe' && $year == 2030) {
                        $resolvedProduction = capacityToProduction($json->data->capacity->{$key}[$i]) * ademeLoadFactor($key);
                    }

                    if ($scenario->group == 'ademe' && $year == 2040) {
                        $resolvedProduction = (
                            (capacityToProduction($json->data->capacity->{$key}[$i - 1]) +
                             capacityToProduction($json->data->capacity->{$key}[$i + 1])
                            ) / 2 * ademeLoadFactor($key));
                    }

                    $data = new Data;
                    $data->scenario_id = $scenario->id;
                    $data->category_id = $categories[$key]->id;
                    $data->production = $resolvedProduction;
                    $data->capacity = $missingYear
                        ? ($json->data->capacity->{$key}[$i - 1] + $json->data->capacity->{$key}[$i + 1]) / 2
                        : $json->data->capacity->{$key}[$i];
                    $data->year = $year;
                    $data->save();

                    $i++;
                }
            }
        }
    }
}
