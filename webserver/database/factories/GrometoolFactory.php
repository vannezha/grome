<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grometool>
 */
class GrometoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomNumber1 = $this->faker->numberBetween(300,600)/10;
        $randomNumber2 = $this->faker->numberBetween(300,600)/10;
        $randomNumber3 = $this->faker->numberBetween(300,600)/10;
        $randomNumber4 = $this->faker->numberBetween(0,255);
        $randomNumber5 = $this->faker->numberBetween(0,255);
        $randomNumber6 = $this->faker->numberBetween(0,255);
        // $randomNumber = $this->faker->num
        $setpoint = '{"variable":["air_humidity","soil_humidity","temperature","Rlight_intensity","Glight_intensity","Blight_intensity"], "data":{"air_humidity": ' .$randomNumber1 .',"soil_humidity":'.$randomNumber2 .',"temperature":' . $randomNumber3 . ',"Rlight_intensity":' . $randomNumber4 . ',"Glight_intensity":' . $randomNumber5 . ',"Blight_intensity":' . $randomNumber5 . '}}';
            // 'variable': {'a','b',''c'},
            // 'data': [{$randomNumber},{$randomNumber},{$randomNumber}],
        // }";
        // echo($setpoint);
        return [
            'name' => $this->faker->name(),
            'guid' => 'grome'.$this->faker->unique()->numberBetween(800000000,900000000),
            'variable' => '["air_humidity","soil_humidity","temperature","Rlight_intensity","Glight_intensity","Blight_intensity"]',
            'setpoint' => $setpoint,
        ];
    }
}
