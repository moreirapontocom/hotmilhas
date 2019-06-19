<?php

/**
 * 
 * Escreva as classes necessárias para representar um estacionamento.
 * Dica: Seja criativo e demonstre seus conhecimentos de POO.
 * 
 */

// SIMULATING DATABASE

function DB_insert($plate, $model)
{
    $checkin = date('Y-m-d H:i:s');

    // SQL: INSERT INTO cars (plate, model) VALUES ($plate, $model)
    // Query builder: Car::insert(['plate' => $plate, 'model' => $model]);

    // This return simulates last inserted row

    return [
        'plate' => $plate,
        'model' => $model,
        'checkin' => $checkin
    ];
}

function DB_query($plate)
{
    $checkin = date('Y-m-d H:i:s');
    $checkout = date('Y-m-d H:i:s', strtotime('+' . rand(3,24) . ' hours'));

    $stay = (new DateTime($checkin))->diff((new DateTime($checkout)))->format("%H");

    // SQL:
    // SELECT cars.plate, cars.model, parkings.car_id, parkings.checkin 
    // FROM cars 
    // INNER JOIN parkings ON parkings.car_id = cars.id 
    // WHERE cars.plate = $plate 
    // LIMIT 1

    // Query builder:
    // Car::join('parkings', 'parkings.car_id', '=', 'cars.id')
    // ->where('cars.plate', $plate)
    // ->select(['cars.plate', 'cars.model', 'parkings.car_id', 'parkings.checkin'])
    // ->first()

    // This return simulates the fetched row

    return [
        'plate' => $plate,
        'model' => 'Kawasaki Ninja', // fetched from DB
        'checkin' => $checkin, // fetched from DB
        'checkout' => $checkout, // Current timestamp
        'stay' => $stay // checking fetched from DB - current timestamp
    ];
}

class Car {

    /**
     * TABLE cars
     * 
     * id INTEGER AUTO_INCREMENT NOT NULL
     * plate CHAR(7) NOT NULL
     * PRIMARY id
     */

    private $plate;
    private $model;

    public function __construct($plate, $model = '')
    {
        $this->plate = self::formatPlate($plate);
        $this->model = $model;
    }

    public static function formatPlate($plate)
    {
        $plate_letters = substr($plate, 0, 3);
        $plate_numbers = substr($plate, 3, 4);

        return strtoupper($plate_letters) . '-' . $plate_numbers;
    }

    public function getPlate()
    {
        return $this->plate;
    }

    public function getModel()
    {
        return $this->model;
    }
}

class Parking {

    /**
     * TABLE parkings
     * 
     * id INTEGER AUTO_INCREMENT NOT NULL
     * car_id INTEGER NOT NULL
     * checkin CURRENT_TIMESTAMP
     * PRIMARY id
     * FK car_id
     */

    private $plate;
    private $checkin; // TIMESTAMP
    private $checkout; // TIMESTAMP

    public function __construct($plate)
    {
        $this->plate = $plate;
    }

    public function checkin($model)
    {
        $car = new Car($this->plate, $model);
        $insert = DB_insert($car->getPlate(), $car->getModel());
        return $insert['model'] . ' ('.$insert['plate'].') checked in at ' . $insert['checkin'];
    }

    public function checkout()
    {
        $car = new Car($this->plate);
        $query = DB_query($car->getPlate());
        return $query['model'] . ' ('.$query['plate'].') checked in at ' . $query['checkin'] . ' and checked out at ' . $query['checkout'] . ' (parked for '.$query['stay'].' hours)';
    }
}

echo '<strong>Checkin: </strong>';

$in = (new Parking('abc1234'))->checkin('Audi A3');
print_r($in);

echo '<hr>';

echo '<strong>Checkout: </strong>';

$out = (new Parking('abc1234'))->checkout();
print_r($out);

?>

<p>
    File: question2.php
</p>

<a href="javascript:history.back()">&laquo; back to index</a>