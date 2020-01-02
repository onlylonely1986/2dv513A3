<?php 

namespace view;

class ExerciseView {
    private static $clientExercise = 'ExerciseView::clientExercise';
    private static $clientTrainingWeight = 'ExerciseView::clientTrainingWeight';
    private static $clientTrainingReps = 'ExerciseView::clientTrainingReps';
    private static $clientTrainingResttime = 'ExerciseView::clientTrainingResttime';
    private static $send = 'ExerciseView::send';


    private function ExerciseFormHTML() {
        return 
            '<form href="?" method="POST">
                <p>' . $this->message . '</p>
                <h3>Exercise info:</h3>
                <label for="">Exercise:</label>
                    <input type="text" id="' . self::$clientExercise . '" name="' . self::$clientExercise . '" />
                    <label for="">Weight:</label>
                    <input type="text" id="' . self::$clientTrainingWeight . '" name="' . self::$clientTrainingWeight . '" />
                    <label for="">Reps:</label>
                    <input type="text" id="' . self::$clientTrainingReps . '" name="' . self::$clientTrainingReps . '" />
                    <label for="">RestTime:</label>
                    <input type="text" id="' . self::$clientTrainingResttime . '" name="' . self::$clientTrainingResttime . '" />
                <input type="submit" id="' . self::$send2 . '" name="' . self::$send2 . '" value="Save"/>
            ';
      }
}
