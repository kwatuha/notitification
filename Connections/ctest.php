<?php
/*
|--------------------------------------------------------------------------
| Dynamic Task file
|--------------------------------------------------------------------------
|
| This file basically fetches all the respective tasks from the API using
| DataProvider object and builds a task out of it using TaskMaker
|
|
*/
// Fetch data from the API
// $tasks = json_decode(
//             (new GuzzleHttp\Client())->get('http://localhost:8000/api/v1/tasks')->getBody(),
//             false
//         );
// $sch = new Crunz\Schedule();
// foreach ($tasks as $task) {    
//     $task = (object) $task;
//     (new App\TaskBuilder(
//         $task,
//         $sch->run($task->run)
//     ))
//     ->generate();
// }
// return $sch;

use Crunz\Schedule;

$schedule = new Schedule();

$schedule->run( function() {
                echo 'Howdy'; 
        } )
        ->description( 'Test task' )
        ->everyMinute();

return $schedule;

?>

<?php
$date = date_create();
echo date_format($date, 'U = Y-m-d H:i:s') . "\n";

date_timestamp_set($date, 1171502725);
echo date_format($date, 'U = Y-m-d H:i:s') . "\n";
